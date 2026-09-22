<?php

namespace App\Checkout;

use App\Interfaces\PricingRule;
use InvalidArgumentException;

class PricingRules
{
    private array $rules = [];

    public function __construct(array $pricingRules)
    {
        $factory = new PricingRuleFactory();

        foreach ($pricingRules as $item => $pricingRule) {
            $this->rules[$item] = $factory->create($pricingRule);
        }

    }

    public function get(string $item): PricingRule
    {
        if (!isset($this->rules[$item])) {
            throw new InvalidArgumentException(
                "Item '{$item}' does not exist."
            );
        }

        return $this->rules[$item];
    }
}
