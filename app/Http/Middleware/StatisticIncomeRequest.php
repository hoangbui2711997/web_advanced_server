<?php

namespace App\Http\Middleware;

use App\Consts;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StatisticIncomeRequest
{
    public function handle(Request $request, Closure $next)
    {
    	try {
			Log::warning($request->getRequestUri());
			if (!Str::contains($request->getRequestUri(), ['/product/', '/program/'])) {
				return $next($request);
			}
			session_start();
			$this->checkTime();

			if (isset($_SESSION[$request->getRequestUri()])) {
				$_SESSION[$request->getRequestUri()]++;
				Log::warning('@4');
				if ($_SESSION[$request->getRequestUri()] === Consts::$THREAT_HOLD + 1) {
					$_SESSION[sha1($request->getRequestUri())] = \Cache::store('redis')->get(sha1(request()->getUri()));
					return response()->json([
						'data' => $_SESSION[sha1($request->getRequestUri())]
					]);
				}
				Log::warning('@5');
				if ($_SESSION[$request->getRequestUri()] > Consts::$THREAT_HOLD + 1) {
					Log::warning($_SESSION[sha1($request->getRequestUri())]);
					Log::warning('@6');
					return response()->json([
						'data' => $_SESSION[sha1($request->getRequestUri())]
					]);
				}
			} else {
				$_SESSION[$request->getRequestUri()] = 1;
			}

			$result = $next($request);
			Log::warning($result);
			Log::warning('@3');
			if ($_SESSION[request()->getRequestUri()] === Consts::$THREAT_HOLD) {
				\Cache::store('redis')->put(sha1(request()->getUri()), $result);
				return \Cache::store('redis')->get(sha1(request()->getUri()), $result);
			}
			Log::warning('@2');
			if ($_SESSION[request()->getRequestUri()] > Consts::$THREAT_HOLD) {
				return \Cache::store('redis')->get(sha1(request()->getUri()), $result);
			}
			Log::warning('@1');
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
		} elseif (!$_SESSION[$startTime]->addMinutes(15)->isFuture()) {
			$_SESSION[$startTime] = now();
			$_SESSION[request()->getRequestUri()] = 0;
			Cache::store('redis')->forget(sha1(request()->getRequestUri()));
		}
	}
}
