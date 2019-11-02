<?php

namespace App\Models;

use App\Custom\CustomModel;

class FlowerImage extends CustomModel
{
	public function productVariation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(ProductVariation::class, 'product_variation_id');
	}
}
