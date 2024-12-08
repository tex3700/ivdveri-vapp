<?php

declare(strict_types=1);

namespace Konekt\Search\Exceptions;

use Exception;

class UnsupportedDatabaseEngineException extends Exception
{
    public static function fromDriverName(string $driver): self
    {
        return new self(sprintf('The `%s` database engine is not supported by the search package', $driver));
    }
}
