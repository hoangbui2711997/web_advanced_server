<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
		'street' => $faker->streetAddress,
		'home_number' => $faker->streetName,
		'zipcode_id' => \App\Models\ZipCode::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
    ];
});
