<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\UserInfo::class, function (Faker $faker) {
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'gender' => random_int(0, 1),
		'birth_day' => $birthday = $faker->dateTime,
		'age' => now()->year - (int) $birthday->format('Y'),
		'point_available' => 0,
		'address_id' => (factory(\App\Models\Address::class)->create())->id,
		'marital_status_id' => \App\Models\MaritalStatus::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
		'user_id' => (factory(\App\Models\User::class)->create())->id,
		'branch_id' => \App\Models\Branch::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
	];
});
