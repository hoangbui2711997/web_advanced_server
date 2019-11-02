<?php


namespace App\Models\Traits;


use App\Models\BranchTable;

trait HasStorageInfo
{
	public function productStorageInfo()
	{
		return $this->morphOne(BranchTable::class, 'objectReference');
	}
}
