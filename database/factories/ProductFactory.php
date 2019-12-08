<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
	\App\Utils::loadImageFromStore();

    return [
        'name' => $name = $faker->unique()->name,
        'slug' => Str::slug($name),
        'price' => $faker->randomDigit,
		'rate' => random_int(0, 5),
		'rate_amount' => $faker->randomDigit,
//		'image_url' => $faker->imageUrl(640, 480, 'nature'),
		'image_url' => '/storage/application/products/'.\App\Utils::$image[array_rand(\App\Utils::$image)],
		'price_base' => $faker->randomDigit,
		'price' => $faker->randomDigit,
		'special_from' => $start = $faker->dateTime,
		'special_to' => $start = $faker->dateTime,
		'amount_in_stock' => $faker->randomDigit,
		'discount_id' => (factory(\App\Models\Discount::class)->create())->id,
		'category_id' => (factory(\App\Models\Category::class)->create())->id,
        'description' => $faker->sentence(5)
    ];
});
