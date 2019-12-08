<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchTable extends Model
{
	/**
	 * Get all of the owning models.
	 */
	public function objectReference(): \Illuminate\Database\Eloquent\Relations\MorphTo
	{
		return $this->morphTo('object_reference');
	}
}
