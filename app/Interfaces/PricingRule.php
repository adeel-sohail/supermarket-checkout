<?php

namespace App\Interfaces;

interface PricingRule
{
    public function calculate(int $quantity): int;
}
