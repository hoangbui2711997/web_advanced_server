<?php

namespace App\Models;

use App\Custom\CustomModel;
use App\Models\Traits\HasStorageInfo;


class Product extends CustomModel
{
	use HasStorageInfo;

	protected $casts = [
		'rate' => 'float'
	];

	public function variations(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(ProductVariation::class);
	}

	public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function discount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Discount::class, 'discount_id');
	}

	public function productExtras(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(ProductExtra::class);
	}
}
