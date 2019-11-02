<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class StatisticIncomeRequest
{
    public function handle($request, Closure $next)
    {
    	try {
			session_start();
			$this->checkTime();

			if (isset($_SESSION[$request->getRequestUri()])) {
				$_SESSION[$request->getRequestUri()]++;
				if ($_SESSION[$request->getRequestUri()] == 7) {
					Log::warning('equal 7 times');
					$_SESSION[sha1($request->getRequestUri())] = \Cache::store('redis')->get(sha1(request()->getUri()));
					return response()->json([
						'data' => $_SESSION[sha1($request->getRequestUri())]
					]);
				}

				if ($_SESSION[$request->getRequestUri()] > 7) {
					Log::warning('greater than 7 times');
					return response()->json([
						'data' => $_SESSION[sha1($request->getRequestUri())]
					]);
				}
			} else {
				$_SESSION[$request->getRequestUri()] = 1;
			}
			return $next($request);
		} catch (\Exception $exception) {
    		Log::warning($exception);
			throw $exception;
		}
    }

	private function checkTime()
	{
		$startTime = request()->getRequestUri() . 'start_time';
		if (!isset($_SESSION[$startTime])) {
			$_SESSION[$startTime] = now();
		} elseif (!$_SESSION[$startTime]->addMinutes(5)->isFuture()) {
			$_SESSION[$startTime] = now();
			$_SESSION[request()->getRequestUri()] = 0;
			Cache::store('redis')->forget(sha1(request()->getRequestUri()));
		}
	}
}
