<?php

namespace Tests\Unit\Models\Country;

use App\Models\Country;
use App\Models\ShippingMethod;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_countries() {
		$country = factory(Country::class)->create();

		$response = $this->json('GET', "api/country/{$country->id}");
//		dd($response->getContent());
		$response->assertJsonFragment([
			'id' => $country->id
		]);
	}

	public function test_it_has_many_shipping_method()
	{
		$country = factory(Country::class)->create();
		$country->shippingMethods()->attach(
			factory(ShippingMethod::class)->create()
		);

		$this->assertInstanceOf(ShippingMethod::class, $country->shippingMethods->first());
	}
}
