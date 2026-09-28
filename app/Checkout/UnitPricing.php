<?php

namespace App\Checkout;

class UnitPricing implements PricingRule
{

    public function __construct(private readonly int $pricePerUnit)
    {
    }

    public function calculate(int $quantity): int
    {
        return $this->pricePerUnit * $quantity;
    }
}
