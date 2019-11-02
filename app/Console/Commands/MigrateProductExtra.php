<?php

namespace App\Console\Commands;

use App\Consts;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateProductExtra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:product_extra';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'custom:migrate:product_extra';

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
    	$products = Product::all();
    	$products->each(function ($product) {
    		$id = $product->id;
    		$sql = 'insert into dbo.product_extras (name, product_id, unit_id) values ';
    		$sqlRecords = [];
    		$i = 1;
			foreach (Consts::$COLLECTION_EXTRAS as $extra) {
				$sqlRecords[] = "('{$extra}', {$id}, {$i})";
				$i++;
			}
			DB::statement($sql.implode(', ', $sqlRecords));
		});
    }
}
