<?php

declare(strict_types=1);

/**
 * Contains the Person interface.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2017-12-04
 *
 */

namespace Vanilo\Contracts;

interface Person extends Contactable
{
    /**
     * Returns the first name of the person
     */
    public function getFirstName(): ?string;

    /**
     * Returns the last name of the person
     */
    public function getLastName(): ?string;

    /**
     * Returns the full name of the person (in appropriate name order)
     */
    public function getFullName(): string;
}
