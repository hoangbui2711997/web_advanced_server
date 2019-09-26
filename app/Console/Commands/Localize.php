<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class Localize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'localization';
    private $supportedLangs = ['en'];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Localization';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

	private function getPhpFiles($lang)
	{
		return array_map(function ($file) {
			return Str::substr($file, 0, strlen($file) - 4);
		}, array_filter(scandir("resources/lang/$lang"), function ($fileName) {
			return Str::endsWith($fileName, '.php');
		}));
	}

	private function handlePhpFile()
	{
		foreach ($this->supportedLangs as $supportedLang) {
			$files = $this->getPhpFiles($supportedLang);
			foreach ($files as $fileWithoutExtension) {
				$localizeMap = Lang::get($fileWithoutExtension, [], $supportedLang);
				$fileName = "resources/lang/${supportedLang}/${fileWithoutExtension}.php";
//				File::put($fileName, "<?php \n");
				$handledLocalizeMap = [];
				foreach ($localizeMap as $key => $value) {
					Arr::set($handledLocalizeMap, $key, $value);
				}
//				File::append($fileName, );
//				File::append($fileName, "\n ];");
			}
		}
	}

	private function sortJsonFiles()
	{
		foreach ($this->supportedLangs as $supportedLang) {
			$path = "resources/lang/${supportedLang}.json";
			$jsonEncode = file_get_contents($path);
			$jsonDecode = collect(json_decode($jsonEncode, true))->toArray();
			ksort($jsonDecode);
			file_put_contents($path, json_encode($jsonDecode, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}
	}

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//    	$this->handlePhpFile();
    	$this->sortJsonFiles();
		Artisan::call('vue-i18n:generate');
    }
}
