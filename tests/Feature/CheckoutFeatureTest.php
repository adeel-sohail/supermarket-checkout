<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\JsonResponse;

class CheckoutFeatureTest extends TestCase
{
    public function test_checkout_returns_total(): void
    {
        $response = $this->postJson('api/checkout', [
            'items' => ['A', 'A', 'A'],
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'total' => 130,
            ]);
    }



    public function test_checkout_returns_empty_response(): void {
        $response = $this->postJson('api/checkout', [
            'items' => [],
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'total' => 0,
            ]);
    }
}
