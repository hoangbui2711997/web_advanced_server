<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\InvoiceDetail::class, function (Faker $faker) {

	$tableName = array_keys(\App\Consts::$DECORATIONS)[random_int(0, count(\App\Consts::$DECORATIONS) - 1)];
	return [
		'type' => $tableName,
		'price' => $price = $faker->randomDigit,
		'quantity' => $quantity = $faker->randomDigit,
		'amount' => $price * $quantity,
		'foreign_id' => \Illuminate\Support\Facades\DB::table($tableName)->orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
		'invoice_id' => \App\Models\Invoice::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
		'note_id' => (factory(\App\Models\Note::class)->create())->id,
		'discount_id' => \App\Models\Discount::orderByRaw(\Illuminate\Support\Facades\DB::raw('newid()'))->first()->id,
	];
});
