<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductExtra;
use Faker\Generator as Faker;

$factory->define(\App\Models\ProductExtraVariation::class, function (Faker $faker) {
	return [
		'amount' => random_int(1, 25),
		'price_base' => $faker->randomFloat(2),
		'price' => $faker->randomFloat(2),
		'special_from' => $from = $faker->dateTime,
		'special_to' => \Illuminate\Support\Carbon::instance($from)->addDays(random_int(1, 30)),
		'product_extra_id' => ProductExtra::orderByRaw(DB::raw('newid()'))->first()->id,
		'discount_id' => (factory(\App\Models\Discount::class)->create())->id,
		'created_at' => $createAt = $faker->dateTime,
		'updated_at' => $createAt,
	];
});
