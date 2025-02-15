<?php

namespace App\Console\Commands;

use App\Models\LocationType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MigrateLocationType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:location-type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$strRaw = 'Home,Apartment,Company or Business,Hospital/Nursing Home,Funeral Home,Church';
		$names = explode(',', $strRaw);
		try {
			DB::beginTransaction();
			foreach ($names as $name) {
				LocationType::insert(['type' => $name]);
			}

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
		}
    }
}
