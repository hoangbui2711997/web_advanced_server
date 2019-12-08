<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\DetailProductInCart::class, function (Faker $faker) {
	$morph = array_rand(\App\Consts::$MORPHS);
    return [
        'product_in_cart_id' => \App\Models\ProductInCart::inRandomOrder()->first()->id,
		'detail_morph_type' => $morph,
		'detail_morph_id' => DB::table(\App\Consts::$MORPHS[$morph])->inRandomOrder()->first()->id,
		'decoration_field' => \App\Consts::$DECORATIONS[\App\Consts::$MORPHS[$morph]]
    ];
});
