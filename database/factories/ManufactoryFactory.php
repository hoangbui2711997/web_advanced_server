<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Manufactory::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'address' => $faker->address,
		'phone_number' => $faker->phoneNumber,
		'delegate_person' => $faker->name
	];
});
