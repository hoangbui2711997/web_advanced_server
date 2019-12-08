<?php

namespace App\Models;

use App\Custom\CustomModel;

use App\Models\Traits\HasStorageInfo;

class ProductExtraVariation extends CustomModel
{
	use HasStorageInfo;

	public function productExtra(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(ProductExtra::class, 'product_extra_id');
	}
}
