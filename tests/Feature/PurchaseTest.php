<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_purchase_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity_available' => 10]);

        $response = $this->actingAs($user)->post(route('purchase.buy', $product->id), [
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('purchase.index'));
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'quantity_available' => 8, // Original 10 - 2 = 8
        ]);
    }

    public function test_user_cannot_purchase_out_of_stock_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity_available' => 0]);

        $response = $this->actingAs($user)->post(route('purchase.buy', $product->id), [
            'quantity' => 1,
        ]);

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('error', 'This product is out of stock!');
    }
}

