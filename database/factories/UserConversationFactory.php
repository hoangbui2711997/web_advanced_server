<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\UserConversation::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::whereHas('roles', function ($query) {
        	$query->where('name', 'USER');
		}, '>', '0')->inRandomOrder()->first()->id,
		'message' => $faker->sentence(20),
    ];
});
