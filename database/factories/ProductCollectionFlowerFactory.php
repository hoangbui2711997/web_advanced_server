<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ProductCollectionFlower::class, function (Faker $faker) {
	return [
		'collection_flower_id' => \App\Models\CollectionFlower::inRandomOrder()->first()->id,
		'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
	];
});
