<?php

namespace App\Models;

use App\Custom\CustomModel;
use Illuminate\Database\Eloquent\Builder;

class Navigator extends CustomModel
{
	protected $with = ['childrens'];
	protected $fillable = ['parent_id', 'level', 'title', 'order', 'link'];

	public function childrens()
	{
		return $this->hasMany(Navigator::class, 'parent_id', 'id')->orderBy('order');
	}

	public function scopeParent()
	{
		return $this->belongsTo(Navigator::class, 'id', 'parent_id');
	}

	public function scopeIsParent(Builder $builder)
	{
		return $builder->whereNull('parent_id');
	}

	public function scopeOrdered(Builder $builder) {
		return $builder->orderBy('order');
	}
}
