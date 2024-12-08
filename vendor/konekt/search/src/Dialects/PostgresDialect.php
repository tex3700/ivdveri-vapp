<?php

declare(strict_types=1);

namespace Konekt\Search\Dialects;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;
use Konekt\Search\Contracts\SearchDialect;
use Konekt\Search\ModelToSearchThrough;

class PostgresDialect extends BaseDialect implements SearchDialect
{
    protected bool $similarSearch = false;

    public function getName(): string
    {
        return 'Postgres';
    }

    public function buildQueries(Collection $modelsToSearchThrough): Collection
    {
        return $modelsToSearchThrough->map(function (ModelToSearchThrough $modelToSearchThrough) {
            return $modelToSearchThrough->getFreshBuilder()
                ->select(
                    array_merge([new Expression('CAST(NULL AS bigint)')], $this->searcher->makeSelects($modelToSearchThrough))
                )
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
            // SELECT * FROM mytable WHERE mycolumn LIKE '%hello%' AND similarity(mycolumn, 'hello') > 0.5;
            if ($this->similarSearch) {
                $this->searcher->isCaseInsensitive()
                    ? $query->orWhereRaw("LOWER({$column}) LIKE ? OR similarity({$column}, ?) > 0.4", [$term, str_replace('%', '', $term)])
                    : $query->orWhereRaw("{$column} LIKE ? OR similarity({$column}, ?) > 0.4", [$term, str_replace('%', '', $term)]);
            } else {
                $this->searcher->isCaseInsensitive()
                    ? $query->orWhereRaw("LOWER({$column}) LIKE ?", [$term])
                    : $query->orWhere($column, 'LIKE', $term);
            }
        });
    }

    public function useSoundex(): void
    {
        $this->similarSearch = true;
    }

    public function avoidSoundex(): void
    {
        $this->similarSearch = false;
    }

    public function makeCoalesce(Collection $keys): string
    {
        return 'COALESCE(' . $keys->implode(', ') . ')';
    }

    public function charLengthFunction(): string
    {
        return 'CHAR_LENGTH';
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
