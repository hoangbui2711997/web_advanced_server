<?php

namespace App\Models;

use App\Custom\CustomModel;

class Cart extends CustomModel
{
    //
	protected $fillable = ['user_id', 'total'];
	protected $with = ['products'];

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(ProductInCart::class);
	}
}
