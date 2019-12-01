<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:refresh';

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
		$this->call('migrate:rollback', ['--step' => '1000']);
		$this->call('migrate');
		$this->call('passport:install', ['--force']);
		$this->call('custom:migrate:unit');
    	$this->call('custom:migrate:zip_code');
//    	$this->call('custom:migrate:product_extra');
    	$this->call('custom:migrate:role');
    	$this->call('custom:migrate:marital');
    	$this->call('custom:migrate:branch');
    	$this->call('custom:migrate:note_type');
		$this->call('custom:migrate:permission');
		$this->call('custom:migrate:user');
		$this->call('db:seed');
		$this->call('custom:migrate:role_permission');

		$this->call('custom:migrate:invoice');
		$this->call('custom:migrate:invoice-detail');
		$this->call('custom:migrate:salary');
    }
}
