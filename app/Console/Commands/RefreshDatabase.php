<?php

namespace App\Console\Commands;

use App\Models\DetailProductInCart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\ProductInCart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
		try {
			DB::beginTransaction();

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

//		$this->call('custom:migrate:invoice');
			factory(Invoice::class, 1000)->create();
			factory(ProductInCart::class, 5000)->create();
			factory(DetailProductInCart::class, 10000)->create();
			factory(InvoiceDetail::class, 10000)->create();
//		$this->call('custom:migrate:invoice-detail');
			$this->call('custom:migrate:salary');
			$this->call('custom:migrate:collection_flower');
			$this->call('custom:migrate:location-type');
//		$this->call('custom:collection:time-update');
			$this->call('custom:migrate:conversation');
			$this->call('custom:migrate:user_conversation');
			$this->call('custom:migrate:employee_conversation');

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
		}
    }
}
