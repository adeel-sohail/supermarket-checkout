<?php

namespace App\Checkout;

class CheckoutService
{
    private const string CONFIG_FILE = 'pricing_rules';

    public function checkout(array $items): int
    {
        $pricingRulesConfig = config(self::CONFIG_FILE);
        $pricingRules = new PricingRules($pricingRulesConfig);

        $checkout = new Checkout($pricingRules);
        foreach ($items as $item) {
            $checkout->scan($item);
        }
        return $checkout->total();
    }
}
