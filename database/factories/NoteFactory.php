<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Note::class, function (Faker $faker) {
	return [
		'message_from' => $faker->name,
		'message' => $faker->sentence,
		'type_id' => \App\Models\NoteType::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
	];
});
