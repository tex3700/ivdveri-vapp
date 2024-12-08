<?php

declare(strict_types=1);
/**
 * Contains the UpdatePropertyValue class.
 *
 * @copyright   Copyright (c) 2018 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2018-12-19
 *
 */

namespace Vanilo\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Vanilo\Admin\Contracts\Requests\UpdatePropertyValue as UpdatePropertyValueContract;

class UpdatePropertyValue extends FormRequest implements UpdatePropertyValueContract
{
    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'title' => 'required|min:1|max:255',
            'value' => 'nullable|min:1|max:255',
            'property_id' => 'required|exists:properties,id',
            'priority' => 'nullable|integer'
        ];
    }

    /**
     * @inheritDoc
     */
    public function authorize()
    {
        return true;
    }
}
