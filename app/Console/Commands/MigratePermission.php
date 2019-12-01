<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MigratePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:permission';

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
		$items = json_decode(file_get_contents(base_path() . '/database/migrations/data/flowers_dbo_permissions.json'));
		$recordPermissions = [];
		Log::warning(collect($items));

		foreach ($items as $item) {
			$recordPermissions[] = [
				'name' => $item->name
			];
		}
		DB::table('permissions')->insert($recordPermissions);
    }
}
