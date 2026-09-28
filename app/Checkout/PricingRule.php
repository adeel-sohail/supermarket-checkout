<?php

namespace App\Checkout;

interface PricingRule
{
    public function calculate(int $quantity): int;
}
