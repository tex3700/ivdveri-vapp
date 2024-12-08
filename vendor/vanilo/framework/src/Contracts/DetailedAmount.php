<?php

declare(strict_types=1);

/**
 * Contains the DetailedAmount interface.
 *
 * @copyright   Copyright (c) 2023 Vanilo UG
 * @author      Attila Fulop
 * @license     MIT
 * @since       2023-02-28
 *
 */

namespace Vanilo\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface DetailedAmount extends Arrayable
{
    public function getValue(): float;

    /** @return array{0: array{title: string, amount:float}} */
    public function getDetails(): array;

    public function getDetail(string $title): float|int|null;
}
