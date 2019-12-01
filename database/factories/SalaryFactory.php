<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Salary::class, function (Faker $faker) {
	return [
		'basic_salary' => $salary = $faker->randomDigit,
		'work_time' => random_int(40, 48),
		'work_over_time' => random_int(8, 40),
		'amount_salary' => $salary + $faker->randomDigit,
		'start_date' => $faker->dateTime,
		'end_date' => now(),
	];
});
