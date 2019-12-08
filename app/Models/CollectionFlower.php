<?php

namespace App\Models;

use App\Consts;
use App\Custom\CustomModel;

class CollectionFlower extends CustomModel
{
	protected $fillable = [
		'name',
		'title',
		'note',
	];

	public function allProduct(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(Product::class, 'product_collection_flowers');
	}
}
