<?php

namespace App\Models;

use App\Custom\CustomModel;

use App\Models\Traits\HasStorageInfo;

class ProductVariation extends CustomModel
{
	use HasStorageInfo;
	protected $with = ['vase', 'images'];
	protected $casts = [
		'rate' => 'float'
	];

	public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function vase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Vase::class, 'vase_id');
	}

	public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(FlowerImage::class);
	}
}
