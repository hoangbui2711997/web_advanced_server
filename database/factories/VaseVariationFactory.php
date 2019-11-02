<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\VaseVariation::class, function (Faker $faker) {
	return [
		'image_url' => $faker->imageUrl(640, 480, 'nature'),
		'size' => \App\Consts::$COLLECTION_VASE_SIZES[random_int(0, 2)],
		'price_base' => $faker->randomDigit,
		'price' => $faker->randomDigit,
		'special_from' => $from = $faker->dateTime,
		'special_to' => \Illuminate\Support\Carbon::instance($from)->addDays(random_int(1, 90)),
		'vase_id' => (\App\Models\Vase::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first())->id,
		'created_at' => $created = $faker->dateTime,
		'updated_at' => $created,
	];
});
