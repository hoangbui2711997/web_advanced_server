<?php

namespace App\Models;

use App\Custom\CustomModel;

use App\Models\Traits\HasStorageInfo;

class Vase extends CustomModel
{
	use HasStorageInfo;
	protected $with = ['variations'];

	public function variations(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(VaseVariation::class);
	}
}
