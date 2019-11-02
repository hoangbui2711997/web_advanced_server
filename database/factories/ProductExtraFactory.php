<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\ProductExtra::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'product_id' => (\App\Models\Product::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first())->id,
		'unit_id' => (\App\Models\Unit::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first())->id,
		'created_at' => $created = $faker->dateTime,
		'updated_at' => $created
	];
});
