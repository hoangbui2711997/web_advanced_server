<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Faker\Generator as Faker;

$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
    	'product_id' => factory(Product::class)->create()->id,
		'price' => $faker->randomDigit,
		'name' => $faker->unique()->name,
		'type_id' => factory(ProductVariationType::class)->create()->id
    ];
});
