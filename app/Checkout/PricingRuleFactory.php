<?php

namespace App\Checkout;

class PricingRuleFactory
{
    public function create(array $pricingRule): PricingRule
    {
        if (isset($pricingRule['special_price']) and isset($pricingRule['special_quantity'])) {
            return new SpecialPricing(
                $pricingRule['price_per_unit'],
                $pricingRule['special_price'],
                $pricingRule['special_quantity'],
            );
        }
        return new UnitPricing(
            $pricingRule['price_per_unit'],
        );
    }
}
