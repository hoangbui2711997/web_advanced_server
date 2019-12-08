<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
	public function test_it_belong_to_user()
	{
		$order = factory(Order::class)->create();
		$this->assertInstanceOf(User::class, $order->user);
	}

	public function test_it_has_default_status_pending()
	{
		$order = factory(Order::class)->create();
		$this->assertEquals(Order::PENDING, $order->status);
	}
}
