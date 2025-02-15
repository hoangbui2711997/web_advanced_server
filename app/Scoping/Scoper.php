<?php


namespace App\Scoping;


use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Scoper
{
	private $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Apply scopes for builder
	 * @param Builder $builder
	 * @param array $scopes
	 * @return Builder
	 */
	public function apply(Builder $builder, array $scopes)
	{
		foreach ($scopes as $key => $scope) {
			if (!$scope instanceof Scope) {
				continue;
			}
			$scope->apply($builder, $this->request->get($key));
		}

		return $builder;
	}
}
