<?php

namespace App\Http\Middleware;

use Closure;

class BuildApiResponse
{
	private $except = [];
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$response = $next($request);

//		foreach ($this->except as $url) {
//			if ($request->path() === $url || $request->is($url)) {
//				return $response;
//			}
//		}

		$original = $response->getOriginalContent();

//		if (!empty(data_get($original, 'exception'))) {
//			return response()->json(['error' => data_get($original, 'message')], $response->status());
//		}
//
//		if (!empty(data_get($original, 'errors'))) {
//			return response()->json($original, $response->status());
//		}
//
//		if (!empty(data_get($original, 'message'))) {
//			return response()->json(['error' => data_get($original, 'message')], $response->status());
//		}

		return response()->json([
			'data' => $original ?? null,
		], $response->status());
	}
}
