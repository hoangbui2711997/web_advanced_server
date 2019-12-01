<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Branch::class, function (Faker $faker) {
	return [
		'name' => $faker->domainName,
		'phone_number' => $faker->phoneNumber,
		'address_id' => (factory(\App\Models\Address::class)->create())->id,
	];
});
