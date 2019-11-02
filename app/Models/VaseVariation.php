<?php

namespace App\Models;

use App\Custom\CustomModel;

use App\Models\Traits\HasStorageInfo;

class VaseVariation extends CustomModel
{
	use HasStorageInfo;

	public function productVariations(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(ProductVariation::class);
	}

	public function vase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Vase::class, 'vase_id');
	}
}
