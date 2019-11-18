<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consts;
use App\Models\Product;
use App\Models\ProductVariation;
use Faker\Generator as Faker;

$factory->define(ProductVariation::class, function (Faker $faker) {
	\App\Utils::loadImageFromStore();

    return [
    	'product_id' => Product::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
		'price' => $faker->randomDigit,
		'description' => $faker->sentence,
		'color' => $faker->colorName,
		'image_url' => '/storage/application/products/'.\App\Utils::$image[array_rand(\App\Utils::$image)],
		'type' => Consts::$COLLECTION_SIZES[random_int(0, 2)],
		'rate' => $faker->randomFloat(2, 0, 5),
		'rate_amount' => $faker->randomDigit,
		'price_base' => $faker->randomFloat(2),
		'special_from' => $from = $faker->dateTime,
		'special_to' => \Carbon\Carbon::instance($from)->addDays(random_int(1, 30)),
		'amount_in_stock' => $faker->randomDigit,
		'vase_id' => (factory(\App\Models\Vase::class)->create())->id,
    ];
});
