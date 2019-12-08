<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\CollectionFlower::class, function (Faker $faker) {
    return [
		'name' => $faker->name,
		'title' => $faker->sentence,
		'note' => $faker->text,
    ];
});
