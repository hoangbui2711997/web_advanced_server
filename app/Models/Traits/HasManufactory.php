<?php


namespace App\Models\Traits;


use App\Models\Manufactory;

trait HasManufactory
{
	public function manufactory(): \Illuminate\Database\Eloquent\Relations\MorphToMany
	{
		return $this->morphToMany(Manufactory::class, 'manufactory_morph');
	}
}
