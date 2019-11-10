<?php

namespace App\Models;

use App\Custom\CustomModel;

use App\Models\Traits\HasStorageInfo;

class ProductExtra extends CustomModel
{
	use HasStorageInfo;
	protected $with = ['variations', 'unit'];

	public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function variations(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(ProductExtraVariation::class);
	}

	public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Unit::class, 'unit_id');
	}
}
