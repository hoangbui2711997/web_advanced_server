<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\EmployeeConversation::class, function (Faker $faker) {
	return [
		'employee_id' => \App\Models\User::whereHas('roles', function ($query) {
			$query->where('name', 'EMPLOYEE');
		}, '>', '0')->inRandomOrder()->first()->id,
		'conversation_id' => \App\Models\Conversation::inRandomOrder()->first()->id,
		'message' => $faker->sentence(20),
    ];
});
