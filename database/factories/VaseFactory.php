<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductVariation;
use Faker\Generator as Faker;

$factory->define(\App\Models\Vase::class, function (Faker $faker) {
	return [
		'image_url' => $faker->imageUrl(128, 128, 'nature'),
		'description' => $faker->sentence,
		'price_base' => $faker->randomDigit,
		'price' => $faker->randomDigit,
		'name' => $faker->name,
		'special_from' => $from = $faker->dateTime,
		'special_to' => \Illuminate\Support\Carbon::instance($from)->addDays(random_int(1, 30)),
		'created_at' => $created = $faker->dateTime,
		'updated_at' => $created,
	];
});
