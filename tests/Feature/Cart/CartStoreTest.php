<?php

namespace Tests\Feature\Cart;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartStoreTest extends TestCase
{

	public function test_it_fails_if_unauthenticated()
	{
		$response = $this->json('POST', 'api/cart');
		$response->assertStatus(401);
	}

	public function test_it_requires_products()
	{
		$user = factory(User::class)->create();
		$token = $user->createToken('Token')->accessToken;
		$this->withHeader('Authorization', "Bearer {$token}");
		$response = $this->json('POST', 'api/cart');
		$response->assertJsonValidationErrors(['products']);
	}

	public function test_it_products_to_be_an_array()
	{
		$user = factory(User::class)->create();
		$token = $user->createToken('Token')->accessToken;
		$this->withHeader('Authorization', "Bearer {$token}");
		$response = $this->json('POST', 'api/cart', [
			'products' => 1
		]);
		$response->assertJsonValidationErrors(['products']);
	}
}
