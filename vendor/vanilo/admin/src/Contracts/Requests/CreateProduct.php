<?php

declare(strict_types=1);
/**
 * Contains the CreateProduct request interface.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2017-10-19
 *
 */

namespace Vanilo\Admin\Contracts\Requests;

use Konekt\Concord\Contracts\BaseRequest;

interface CreateProduct extends BaseRequest
{
    public function channels(): array;
}
