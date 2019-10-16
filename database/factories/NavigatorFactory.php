<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Navigator;
use Faker\Generator as Faker;

$factory->define(Navigator::class, function (Faker $faker) {
	return [
		'parent_id' => null,
		'link' => $faker->url,
		'icon' => $faker->url,
		'title' => $faker->title,
		'level' => $faker->randomNumber(1),
		'created_at' => $faker->dateTime,
		'updated_at' => $faker->dateTime,
		'order' => $faker->randomNumber(1),
	];
});
