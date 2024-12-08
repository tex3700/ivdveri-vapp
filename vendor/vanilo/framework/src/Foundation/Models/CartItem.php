<?php

declare(strict_types=1);

/**
 * Contains the CartItem class.
 *
 * @copyright   Copyright (c) 2023 Vanilo UG
 * @author      Attila Fulop
 * @license     MIT
 * @since       2023-03-26
 *
 */

namespace Vanilo\Foundation\Models;

use Vanilo\Adjustments\Contracts\Adjustable;
use Vanilo\Adjustments\Support\HasAdjustmentsViaRelation;
use Vanilo\Adjustments\Support\RecalculatesAdjustments;
use Vanilo\Cart\Models\CartItem as BaseCartItem;
use Vanilo\Taxes\Contracts\Taxable;
use Vanilo\Taxes\Contracts\TaxCategory;

class CartItem extends BaseCartItem implements Adjustable, Taxable
{
    use HasAdjustmentsViaRelation;
    use RecalculatesAdjustments;

    public function getTaxCategory(): ?TaxCategory
    {
        $buyable = $this->getBuyable();
        if ($buyable instanceof Taxable) {
            return $buyable->getTaxCategory();
        }

        return null;
    }

    public function preAdjustmentTotal(): float
    {
        return $this->price * $this->quantity;
    }

    public function total(): float
    {
        return $this->preAdjustmentTotal() + $this->adjustments()->total();
    }
}
