<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
	return [
		'user_id' => factory(\App\Models\User::class)->create()->id,
		'address_id' => factory(\App\Models\Address::class)->create()->id,
		'shipping_method_id' => factory(\App\Models\ShippingMethod::class)->create()->id,
	];
});
