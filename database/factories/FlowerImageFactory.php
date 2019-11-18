<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Utils;
use Faker\Generator as Faker;

$factory->define(\App\Models\FlowerImage::class, function (Faker $faker) {
	Utils::loadImageFromStore();

	return [
		'image_url' => '/storage/application/products/'.\App\Utils::$image[array_rand(\App\Utils::$image)],
		'description' => $faker->sentence,
		'product_variation_id' => (\App\Models\ProductVariation::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first())->id,
		'created_at' => $created = $faker->dateTime,
		'updated_at' => $created,
	];
});
