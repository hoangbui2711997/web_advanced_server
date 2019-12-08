<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateZipCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:zip_code';

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
        //
		DB::statement("insert into zip_codes (id, name, asciiname, alternatenames, latitude, longitude, feature_class, 
                       feature_code, country_code, cc2, admin1_code, admin2_code, admin3_code, admin4_code, population, 
                       elevation, dem, timezone, modification_date, created_at, updated_at) select geonameid, name, asciiname,
					   alternatenames, latitude, longitude, feature_class, [feature_code], country_code, cc2, admin1_code,
                       admin2_code, admin3_code, admin4_code, population, elevation, dem, timezone, modification_date,
                       created_at, updated_at from geonames");
    }
}
