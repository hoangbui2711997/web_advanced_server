<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateMaritalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:marital';

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
        DB::table('marital_statuses')->insert([
        	[
        		'status' => 'single'
			],
			[
				'status' => 'married'
			],
			[
				'status' => 'engaged'
			],
			[
				'status' => 'in a relationship'
			],
			[
				'status' => 'divorce'
			],
			[
				'status' => 'divorced'
			],
		]);
    }
}
