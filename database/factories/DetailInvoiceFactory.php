<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\InvoiceDetail::class, function (Faker $faker) {
	return [
		'amount' => $faker->randomDigitNotNull,
		'invoice_id' => \App\Models\Invoice::inRandomOrder()->first()->id,
		'product_in_cart_id' => \App\Models\ProductInCart::inRandomOrder()->first()->id,
//		'note_id' => (factory(\App\Models\Note::class)->create())->id,
	];
});
