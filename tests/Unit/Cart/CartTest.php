<?php

namespace Tests\Unit\Cart;

use App\Card\Cart;
use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
	public function test_it_can_add_products_to_the_cart()
	{
		$cart = new Cart(
			$user = factory(User::class)->create()
		);

		$product = factory(ProductVariation::class)->create();

		$cart->add([
			[
				'id' => $product->id,
				'quantity' => 1
			]
		]);

		$this->assertCount(1, $user->fresh()->cart);
	}
}
