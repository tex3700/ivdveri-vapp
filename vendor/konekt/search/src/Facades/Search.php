<?php

declare(strict_types=1);

namespace Konekt\Search\Facades;

use Illuminate\Support\Facades\Facade;
use Konekt\Search\Searcher;

/**
 * @method static Searcher new()
 * @method static Searcher orderByAsc()
 * @method static Searcher orderByDesc()
 * @method static Searcher dontParseTerm()
 * @method static Searcher includeModelType()
 * @method static Searcher beginWithWildcard(bool $state)
 * @method static Searcher endWithWildcard(bool $state)
 * @method static Searcher soundsLike(bool $state)
 * @method static Searcher add($query, $columns, string $orderByColumn = null)
 * @method static Searcher when($value, callable $callback = null, callable $default = null)
 * @method static Searcher addMany($queries)
 * @method static Searcher paginate($perPage = 15, $pageName = 'page', $page = null)
 * @method static Searcher simplePaginate($perPage = 15, $pageName = 'page', $page = null)
 * @method static \Illuminate\Support\Collection parseTerms(string $terms, callable $callback = null)
 * @method static \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator get(string $terms = null)
 *
 */
class Search extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'konekt-search';
    }
}
