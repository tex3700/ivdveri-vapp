<?php

declare(strict_types=1);

/**
 * Contains the CreatePaymentMethod class.
 *
 * @copyright   Copyright (c) 2020 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2020-12-08
 *
 */

namespace Vanilo\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Vanilo\Admin\Contracts\Requests\CreatePaymentMethod as CreatePaymentMethodContract;
use Vanilo\Payment\PaymentGateways;

class CreatePaymentMethod extends FormRequest implements CreatePaymentMethodContract
{
    use HasChannels;

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'gateway' => ['required', Rule::in(PaymentGateways::ids())],
            'configuration' => 'sometimes|json',
            'zone_id' => 'sometimes|nullable|exists:zones,id',
            'is_enabled' => 'sometimes|boolean',
            'description' => 'sometimes|nullable|string',
            'channels' => 'sometimes|array',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
