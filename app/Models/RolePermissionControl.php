<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermissionControl extends Model
{
    //
	public function rolePermission(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(RolePermission::class, 'role_permission_id');
	}
}
