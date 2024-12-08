<?php

declare(strict_types=1);

/**
 * Contains the Integer class.
 *
 * @copyright   Copyright (c) 2018 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2018-12-08
 *
 */

namespace Vanilo\Properties\Types;

use Vanilo\Properties\Contracts\PropertyType;

class Integer implements PropertyType
{
    public function getName(): string
    {
        return __('Integer');
    }

    public function transformValue(string $value, ?array $settings)
    {
        return (int) $value;
    }
}
