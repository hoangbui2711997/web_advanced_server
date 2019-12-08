<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
	protected $with = ['control'];
    //
	public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Role::class, 'role_id');
	}

	public function permission(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Permission::class, 'permission_id');
	}

	public function controls(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(RolePermissionControl::class);
	}
}
