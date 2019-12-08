<?php


namespace App\Models\Traits;


use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;

trait CanBeScoped
{
	/**
	 * Return a collection of product have certain scopes
	 * @param Builder $builder
	 * @param $scopes
	 * @return Builder
	 */
	// inject builder with scope prefix
	public function scopeWithScopes(Builder $builder, $scopes)
	{
		return (new Scoper(request()))->apply($builder, $scopes);
	}
}
