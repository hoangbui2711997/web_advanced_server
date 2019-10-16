<?php

namespace Tests\Unit\Models;

use App\Card\Money;
use App\Models\ShippingMethod;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShippingMethodTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
	public function test_it_return_instance_of_price()
	{
		$shippingMethod = factory(ShippingMethod::class)->create();

		$this->assertInstanceOf(Money::class, $shippingMethod->price);
	}
}
