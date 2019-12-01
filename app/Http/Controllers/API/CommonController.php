<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\CommonService;

class CommonController extends Controller
{
//	public function showAPIs__()
//	{
//		Artisan::call('route:api');
//		// Setup the file descriptors
//		$descriptors = [
//			0 => ['pipe', 'w'],
//			1 => ['pipe', 'w'],
//			2 => ['pipe', 'w'],
//		];
//
//		// Start the script
//		$proc = proc_open('php artisan route:api', $descriptors, $pipes, '/home/jetly/backup-1/web_advanced_server');
//
//		// Read the stdin
//		$stdin = stream_get_contents($pipes[0]);
//		fclose($pipes[0]);
//
//		// Read the stdout
//		$stdout = stream_get_contents($pipes[1]);
//		fclose($pipes[1]);
//
//		// Read the stderr
//		$stderr = stream_get_contents($pipes[2]);
//		fclose($pipes[2]);
//
//		Log::warning('$stdin');
//		Log::warning($stdin);
//		Log::warning('$stdout');
//		Log::warning($stdout);
//		Log::warning('$stderr');
//		Log::warning($stderr);
//
//		// Close the script and get the return code
//		$return_code = proc_close($proc);
//
//		dd(json_decode($stdout));
////		$stdin = stream_get_contents($pipes[0]);
////		fclose($pipes[0]);
////		Log::warning(Artisan::output());
////		dd(Artisan::output());
//		return Artisan::output();
//	}

	private $commonService;

	public function __construct(CommonService $commonService)
	{
		$this->commonService = $commonService;
	}

	public function showAPIs()
	{
		$this->commonService->showAPIs();
	}
}
