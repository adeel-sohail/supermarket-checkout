<?php

namespace App\Checkout;


class Checkout
{
    private array $itemQuantities = [];

    public function __construct(
        private readonly PricingRules $pricingRules)
    {
    }

    public function scan(string $item): void
    {
        $this->pricingRules->get($item);
        $this->itemQuantities[$item] = ($this->itemQuantities[$item] ?? 0) + 1;
    }

    public function total(): int
    {
        $total = 0;

        foreach ($this->itemQuantities as $item => $quantity) {
            $pricingRule = $this->pricingRules->get($item);
            $total += $pricingRule->calculate($quantity);
        }

        return $total;
    }
}
