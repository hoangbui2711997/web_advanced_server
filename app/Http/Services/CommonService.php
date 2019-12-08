<?php


namespace App\Http\Services;


use App\Consts;
use App\Models\LocationType;
use App\Models\NoteType;
use App\Models\ZipCode;
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

	public function getLocationTypes()
	{
		return LocationType::all();
	}

	public function getZipcodes($params)
	{
		$searchKey = data_get($params, 'search_key', '');
		$limit = data_get($params, 'limit', Consts::$PER_PAGE);

		return ZipCode::when(!empty($searchKey), function ($query) use ($searchKey) {
			$escapedSearchKey = Utils::escapeLike($searchKey);
			$query->where('id', 'like', "%$escapedSearchKey%");
		})->paginate($limit);
	}

	public function getNodeTypes()
	{
		return NoteType::all();
	}
}
