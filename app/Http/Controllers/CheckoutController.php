<?php

namespace App\Http\Controllers;

use App\Checkout\CheckoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(private readonly CheckoutService $checkoutService)
    {
    }


    public function checkoutPost(Request $request): JsonResponse
    {
        $items = $request->input('items');
        $total = $this->checkoutService->checkout($items);

        return response()->json([
            'total' => $total
        ]);
    }

    public function checkoutGet(): JsonResponse
    {
        $items = [
            'A',
            'B',
            'C',
            'B',
            'A'
        ];
        $total = $this->checkoutService->checkout($items);

        return response()->json([
            'total' => $total
        ]);
    }
}
