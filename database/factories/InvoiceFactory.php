<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Invoice::class, function (Faker $faker) {
	return [
		'service_fee' => $faker->randomDigit,
		'amount' => $faker->randomDigit,
		'status' => \App\Consts::$INVOICE_STATUSES[random_int(0, count(\App\Consts::$INVOICE_STATUSES) - 1)],
		'delivery_date' => $faker->dateTime,
		'instruction' => $faker->sentence(20),
		'employee_id' => \App\Models\User::inRandomOrder()->first()->id,
		'branch_id' => \App\Models\Branch::inRandomOrder()->first()->id,
//		'discount_id' => \App\Models\Discount::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
		'discount_id' => (factory(\App\Models\Discount::class)->create())->id,
	];
});
