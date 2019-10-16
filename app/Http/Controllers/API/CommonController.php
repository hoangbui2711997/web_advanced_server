<?php

namespace App\Http\Controllers\API;

use App\Http\Services\CommonService;
use App\Utils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CommonController extends Controller
{
	private $commonService;
    public function __construct(CommonService $commonService)
	{
		$this->commonService = $commonService;
	}

	public function getNavigators()
	{
		return $this->commonService->getNavigators();
	}

	public function getCategories()
	{
		return $this->commonService->getCategories();
	}

	public function showAPIs__()
	{
		Artisan::call('route:api');
		// Setup the file descriptors
		$descriptors = [
			0 => ['pipe', 'w'],
			1 => ['pipe', 'w'],
			2 => ['pipe', 'w'],
		];

		// Start the script
		$proc = proc_open('php artisan route:api', $descriptors, $pipes, '/home/jetly/backup-1/web_advanced_server');

		// Read the stdin
		$stdin = stream_get_contents($pipes[0]);
		fclose($pipes[0]);

		// Read the stdout
		$stdout = stream_get_contents($pipes[1]);
		fclose($pipes[1]);

		// Read the stderr
		$stderr = stream_get_contents($pipes[2]);
		fclose($pipes[2]);

		Log::warning('$stdin');
		Log::warning($stdin);
		Log::warning('$stdout');
		Log::warning($stdout);
		Log::warning('$stderr');
		Log::warning($stderr);

		// Close the script and get the return code
		$return_code = proc_close($proc);

		dd(json_decode($stdout));
//		$stdin = stream_get_contents($pipes[0]);
//		fclose($pipes[0]);
//		Log::warning(Artisan::output());
//		dd(Artisan::output());
		return Artisan::output();
	}

	public function showAPIs()
	{
		exec("cd " . base_path() . " && php artisan route:list | awk '/GET|HEAD|POST|PUT|DELETE/' | awk '/App\\\\Http\\\\Controllers\\\\API/'", $apis);
		$address = [];
		$result = [];
		$keyAddress = 3;
		Log::warning($apis);
		foreach ($apis as $api) {
			if (!empty($api)) {
				$address[] = [
					'verb' => $verb = implode(Utils::getVerb($api), ','),
					'url' => env('API_URL')
						. '/'
						. trim(explode('|', $api)
						[Str::contains($verb, 'GET|HEAD') ? $keyAddress + 1 : $keyAddress])
				];
			}
		}

		data_set($result, 'address', $address);
		data_set($result, 'apis', $apis);

		return $result;
	}
}
