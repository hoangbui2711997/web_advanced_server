<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $with = ['permissions'];

	public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
	{
		return $this->belongsToMany(Role::class);
	}

	public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
	{
		return $this->hasMany(RolePermission::class);
	}
}
