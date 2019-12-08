<?php

namespace App\Console\Commands;

use App\Models\CollectionFlower;
use App\Models\Product;
use App\Models\ProductCollectionFlower;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateTimeCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:collection:time-update';

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
			$productIds = ProductCollectionFlower::get()->pluck('product_id');
			$productIds->each(function ($id) {
				$product = Product::find($id);
				$product->special_to = now()->addMinutes(random_int(60, 5000));
				$product->save();
			});
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
		}
    }
}
