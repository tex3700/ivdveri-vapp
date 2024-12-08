<?php

declare(strict_types=1);

/**
 * Contains the UpdateSalesFigures class.
 *
 * @copyright   Copyright (c) 2018 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2018-11-11
 *
 */

namespace Vanilo\Foundation\Listeners;

use Vanilo\Contracts\Buyable;
use Vanilo\Order\Contracts\OrderAwareEvent;
use Vanilo\Order\Contracts\OrderItem;

class UpdateSalesFigures
{
    public function handle(OrderAwareEvent $event)
    {
        $order = $event->getOrder();

        foreach ($order->getItems() as $item) {
            /** @var OrderItem $item */
            if ($item->product instanceof Buyable) {
                if ($item->quantity >= 0) {
                    $item->product->addSale($order->ordered_at ?? $order->created_at, $item->quantity);
                } else {
                    $item->product->removeSale(-1 * $item->quantity);
                }
            }
        }
    }
}
