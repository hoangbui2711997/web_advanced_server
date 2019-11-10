<?php

namespace App\Models;

use App\Custom\CustomModel;

class ProductInCart extends CustomModel
{
    //
	protected $with = ['details'];

	public function cart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Cart::class, 'cart_id');
	}

	public function details(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(DetailProductInCart::class);
	}
}
