<?php

namespace App\Checkout;

use InvalidArgumentException;

class PricingRules
{
    private array $rules = [];

    public function __construct(array $pricingRules)
    {
        $resolver = new PricingRuleResolver();

        foreach ($pricingRules as $item => $pricingRule) {
            $this->rules[$item] = $resolver->resolve($pricingRule);
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
