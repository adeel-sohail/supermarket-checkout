<?php

namespace Tests\Unit;

use App\Checkout\Checkout;
use App\Checkout\PricingRules;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{

    public function test_get_total_price(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
                'special_quantity' => 3,
                'special_price' => 130,
            ],
            'B' => [
                'price_per_unit' => 30,
                'special_quantity' => 2,
                'special_price' => 45,
            ],
            'C' => [
                'price_per_unit' => 20,
            ],
            'D' => [
                'price_per_unit' => 15,
            ],
        ];

        $pricingRules = new PricingRules($pricingRulesData);

        $checkout = new Checkout(
            $pricingRules
        );

        $checkout->scan('A');
        $checkout->scan('B');
        $checkout->scan('C');
        $total = $checkout->total();

        $this->assertSame(100, $total);
    }

    public function test_scan_throws_exception_when_item_does_not_exist(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
                'special_quantity' => 3,
                'special_price' => 130,
            ]
        ];
        $pricingRules = new PricingRules($pricingRulesData);

        $checkout = new Checkout(
            $pricingRules
        );

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Item 'X' does not exist.");

        $checkout->scan('X');
    }

    public function test_special_price_is_applied(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
                'special_quantity' => 3,
                'special_price' => 130,
            ],
        ];

        $pricingRules = new PricingRules($pricingRulesData);
        $checkout = new Checkout($pricingRules);

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');

        $this->assertSame(130, $checkout->total());
    }

    public function test_unit_prices_are_added(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
            ],
            'B' => [
                'price_per_unit' => 30,
            ],
        ];

        $pricingRules = new PricingRules($pricingRulesData);
        $checkout = new Checkout($pricingRules);

        $checkout->scan('A');
        $checkout->scan('B');

        $this->assertSame(80, $checkout->total());
    }

    public function test_special_price_with_remaining_unit(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
                'special_quantity' => 3,
                'special_price' => 130,
            ],
        ];

        $pricingRules = new PricingRules($pricingRulesData);
        $checkout = new Checkout($pricingRules);

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');

        $this->assertSame(180, $checkout->total());
    }

    public function test_multiple_special_prices_are_applied(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
                'special_quantity' => 3,
                'special_price' => 130,
            ],
        ];

        $pricingRules = new PricingRules($pricingRulesData);
        $checkout = new Checkout($pricingRules);

        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');
        $checkout->scan('A');

        $this->assertSame(260, $checkout->total());
    }

    public function test_total_updates_as_items_are_scanned(): void
    {
        $pricingRulesData = [
            'A' => [
                'price_per_unit' => 50,
                'special_quantity' => 3,
                'special_price' => 130,
            ],
            'B' => [
                'price_per_unit' => 30,
                'special_quantity' => 2,
                'special_price' => 45,
            ],
        ];

        $pricingRules = new PricingRules($pricingRulesData);
        $checkout = new Checkout($pricingRules);

        $this->assertSame(0, $checkout->total());

        $checkout->scan('A');
        $this->assertSame(50, $checkout->total());

        $checkout->scan('B');
        $this->assertSame(80, $checkout->total());

        $checkout->scan('A');
        $this->assertSame(130, $checkout->total());

        $checkout->scan('A');
        $this->assertSame(160, $checkout->total());

        $checkout->scan('B');
        $this->assertSame(175, $checkout->total());
    }
}
