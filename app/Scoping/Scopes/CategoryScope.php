<?php


namespace App\Scoping\Scopes;


use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
	public function apply(Builder $builder, $value)
	{
//		dd($value);
//		return $builder->where('slug', $value);
		return $builder->whereHas('categories', function (Builder $builder) use ($value) {
			$builder->where('slug', $value);
		});
	}
}
