<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutProcessTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_process()
    {
        $user = User::factory()->create();
        $product = products::factory()->create();

        $this->actingAs($user);

        $this->post(route('cart.add', $product->id));

        $response = $this->get(route('checkout.confirmation'));

        $response->assertStatus(200);
        $response->assertViewIs('checkout.confirmation');

        $response = $this->post(route('checkout.process'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price,
        ]);

        $this->assertSessionHasNoErrors();
        $this->assertSessionDoesntHave('cart');

        $response->assertViewIs('checkout.success');
    }
}
