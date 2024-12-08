<?php

declare(strict_types=1);
/**
 * Contains the UpdateOrder class.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2017-12-17
 *
 */

namespace Vanilo\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Vanilo\Admin\Contracts\Requests\UpdateOrder as UpdateOrderContract;
use Vanilo\Order\Contracts\Order;
use Vanilo\Order\Models\OrderStatusProxy;

class UpdateOrder extends FormRequest implements UpdateOrderContract
{
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(OrderStatusProxy::values())]
        ];
    }

    public function wantsToChangeOrderStatus(Order $order): bool
    {
        return $this->getStatus() !== $order->getStatus()->value();
    }

    public function getStatus(): string
    {
        return $this->get('status');
    }

    public function authorize()
    {
        return true;
    }
}
