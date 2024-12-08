<?php

declare(strict_types=1);

/**
 * Contains the SqliteDialect class.
 *
 * @copyright   Copyright (c) 2023 Vanilo UG
 * @author      Attila Fulop
 * @license     MIT
 * @since       2023-04-04
 *
 */

namespace Konekt\Search\Dialects;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Konekt\Search\Contracts\SearchDialect;
use Konekt\Search\Exceptions\UnsupportedOperationException;
use Konekt\Search\ModelToSearchThrough;

class SqliteDialect extends BaseDialect implements SearchDialect
{
    protected string $whereOperator = 'like';

    public function getName(): string
    {
        return 'SQLite';
    }

    public function buildQueries(Collection $modelsToSearchThrough): Collection
    {
        return $modelsToSearchThrough->map(function (ModelToSearchThrough $modelToSearchThrough) {
            return $modelToSearchThrough->getFreshBuilder()
                ->select($this->searcher->makeSelects($modelToSearchThrough))
                ->tap(function ($builder) use ($modelToSearchThrough) {
                    $this->searcher->addSearchQueryToBuilder($builder, $modelToSearchThrough);
                    $this->searcher->addRelevanceQueryToBuilder($builder, $modelToSearchThrough);
                });
        });
    }

    public function addWhereTermsToQuery(Builder $query, array|string $column): void
    {
        $column = $this->searcher->isCaseInsensitive() ? $query->getGrammar()->wrap($column) : $column;

        $this->searcher->getSearchTerms()->each(function ($term) use ($query, $column) {
            $this->searcher->isCaseInsensitive()
                ? $query->orWhereRaw("LOWER({$column}) LIKE ?", [$term])
                : $query->orWhere($column, 'LIKE', $term);
        });
    }

    public function useSoundex(): void
    {
        throw new UnsupportedOperationException('The SQLite driver does not support similarity matching');
    }

    public function avoidSoundex(): void
    {
    }

    public function makeCoalesce(Collection $keys): string
    {
        $fields = $keys->implode(', ');
        if ($keys->count() < 2) {
            $fields .= ', NULL';
        }

        return "COALESCE({$fields})";
    }

    public function charLengthFunction(): string
    {
        return 'LENGTH';
    }

    public function supportsFullTextSearch(): bool
    {
        return false;
    }

    public function supportsOrderByModel(): bool
    {
        return false;
    }
}
