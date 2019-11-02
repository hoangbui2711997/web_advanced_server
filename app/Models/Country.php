<?php

namespace App\Models;

use App\Custom\CustomModel;

class Country extends CustomModel
{
    //
	public $timestamps = false;
	protected $fillable = [
		'code',
		'name'
	];

	public function shippingMethods()
	{
		return $this->belongsToMany(ShippingMethod::class);
	}
}
