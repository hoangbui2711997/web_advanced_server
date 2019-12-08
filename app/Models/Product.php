<?php

namespace App\Models;

use App\Custom\CustomModel;
use App\Models\Traits\HasStorageInfo;
use App\Utils;
use Illuminate\Support\Carbon;


class Product extends CustomModel
{
	use HasStorageInfo;

	protected $casts = [
		'rate' => 'float'
	];

	public function getSpecialToAttribute()
	{
		return Carbon::parse($this->attributes['special_to'])->unix() * 1000;
	}

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

	public function collections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(CollectionFlower::class);
	}
}
