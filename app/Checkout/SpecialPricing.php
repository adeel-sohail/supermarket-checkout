<?php

namespace App\Checkout;

class SpecialPricing implements PricingRule
{
    public function __construct(
        private readonly int $pricePerUnit,
        private readonly int $specialPrice,
        private readonly int $specialQuantity)
    {

    }

    public function calculate(int $quantity): int
    {
        $multiplier = intdiv($quantity, $this->specialQuantity);
        $remainder = $quantity % $this->specialQuantity;

        return ($this->specialPrice * $multiplier) + ($this->pricePerUnit * $remainder);
    }
}
