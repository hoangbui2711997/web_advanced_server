<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\FlowerImage::class, function (Faker $faker) {
	return [
		'image_url' => $faker->imageUrl(640, 480, 'nature'),
		'description' => $faker->sentence,
		'product_variation_id' => (\App\Models\ProductVariation::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first())->id,
		'created_at' => $created = $faker->dateTime,
		'updated_at' => $created,
	];
});
