<?php


namespace App\Http\Services;


use App\Utils;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CommonService
{
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
					'url' => env('APP_URL')
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
