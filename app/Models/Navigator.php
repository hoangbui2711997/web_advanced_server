<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigator extends Model
{
	protected $with = ['children'];
	protected $fillable = ['parent_id', 'level', 'title', 'order', 'link'];

	public function children()
	{
		return $this->hasMany(Navigator::class, 'parent_id', 'id')->orderBy('order');
	}
}
