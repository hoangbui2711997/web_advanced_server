<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateControl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:custom:control';

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
		$items = json_decode(file_get_contents(base_path() . '/database/migrations/data/flowers_dbo_permission_control.json'));

		foreach ($items as $item) {
			$recordControls = [];
			foreach($item->actions as $action) {
				$recordControls[] = [
					'permission_id' => Permission::where('component_path', $item->nameComponent)->first()->id,
					'name' => $action
				];
			}
			DB::table('controls')->insert($recordControls);
		}
    }
}
