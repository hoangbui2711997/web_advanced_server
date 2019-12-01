<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\DeliverInfo::class, function (Faker $faker) {
	return [
		'date_deliver' => $faker->dateTime,
		'instruction' => $faker->sentence,
	];
});
