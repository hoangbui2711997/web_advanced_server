<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Discount::class, function (Faker $faker) {
	return [
		'percent' => $faker->randomDigit,
		'code' => $faker->uuid
	];
});
