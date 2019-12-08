<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateRolePermission extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'custom:migrate:role_permission';

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
		$items = json_decode(file_get_contents(base_path() . '/database/migrations/data/flowers_dbo_role_permissions.json'));
		$records = [];
		foreach ($items as $item) {
			$records[] = [
				'role_id' => $item->role_id,
				'permission_id' => $item->permission_id,
				'name' => $item->name,
				'path' => $item->path,
				'checked' => $item->checked,
				'created_at' => $item->created_at,
				'updated_at' => $item->updated_at,
			];
		}

		DB::table('role_permissions')->insert($records);
	}
}
