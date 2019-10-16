<?php

namespace Tests\Feature\Models;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
//	use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
	public function test_it_fail_if_not_auth()
	{
		$this->json('POST', 'api/orders')
			->assertStatus(401);
	}

	public function test_it_require_address_shipping_method_id()
	{
		$user = factory(User::class)->create();
		$token = $user->createToken('Token')->accessToken;
		$this->withHeader('Authorization', "Bearer {$token}");
		$this->json('POST', 'api/orders')->assertJsonFragment([
			'address_id' => ['The address id field is required.'],
			'shipping_method_id' => ['The shipping method id field is required.']
		]);
//		Arr::has();
//		$response->assertJsonValidationErrors('address_id', 'data.errors');
//		$response->assertJsonValidationErrors(['errors']);
//		$response->assertJsonValidationErrors(['address_id']);
//		$response->assertJsonValidationErrors(['shipping_method_id']);
	}

	public function test_it_exist_address_shipping_method_id()
	{
		$user = factory(User::class)->create();
		$token = $user->createToken('Token')->accessToken;

		$user->addresses()->save(
			$address = factory(Address::class)->create([
				'user_id' => $user->id
			])
		);
		$this->withHeader('Authorization', "Bearer {$token}");
		$response = $this->json('POST', 'api/orders', [
			'address_id' => $address->id,
			'shipping_method_id' => 1,
		]);
		$response->assertStatus(200);
//		$response->assertJsonFragment([
//			'address_id' => ['The selected address id is invalid.'],
//			'shipping_method_id' => ['The selected shipping method id is invalid.']
//		]);
	}
}
