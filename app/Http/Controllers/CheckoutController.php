<?php

namespace App\Http\Controllers;

use App\Checkout\Checkout;
use App\Checkout\PricingRules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private const string CONFIG_FILE = 'pricing_rules';

    public function checkout(Request $request): JsonResponse
    {

        $pricingRulesConfig = config(self::CONFIG_FILE);
        $pricingRules = new PricingRules($pricingRulesConfig);

        $checkout = new Checkout($pricingRules);

        $checkout->scan('A');
        $checkout->scan('B');
        $checkout->scan('C');
        $checkout->scan('B');
        $checkout->scan('A');

        $total = $checkout->total();
        return response()->json([
            'total' => $total
        ]);
    }
}
