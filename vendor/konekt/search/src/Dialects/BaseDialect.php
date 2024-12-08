<?php

declare(strict_types=1);

namespace Konekt\Search\Dialects;

use Konekt\Search\Searcher;

abstract class BaseDialect
{
    public function __construct(
        protected Searcher $searcher
    ) {
    }
}
