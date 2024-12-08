<?php

declare(strict_types=1);
/**
 * Contains the CreateTaxonomy class.
 *
 * @copyright   Copyright (c) 2018 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2018-09-22
 *
 */

namespace Vanilo\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Vanilo\Admin\Contracts\Requests\CreateTaxonomy as CreateTaxonomyContract;

class CreateTaxonomy extends FormRequest implements CreateTaxonomyContract
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:191',
            'slug' => 'nullable|max:191',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpg,jpeg,pjpg,png,gif,webp',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
