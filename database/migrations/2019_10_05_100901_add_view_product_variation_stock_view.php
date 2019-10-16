<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewProductVariationStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
			create view product_variation_stock_view as
				select
					   product_variations.product_id as product_id,
					   product_variations.id as product_variation_id,
					   COALESCE(sum(stocks.quantity) - COALESCE(sum(product_variation_orders.quantity), 0), 0) as stock,
					   case when coalesce(sum(stocks.quantity) - coalesce(sum(product_variation_orders.quantity), 0), 0) > 0
							then true
							else false
							end as in_stock
				from product_variations
				left join (
					select stocks.product_variation_id as id,
						   sum(stocks.quantity) as quantity
					from stocks
					group by stocks.product_variation_id
				) as stocks using (id)
				left join (
					select product_variation_orders.product_variation_id as id,
						   sum(product_variation_orders.quantity) as quantity
					from product_variation_orders
					group by product_variation_orders.product_variation_id
				) as product_variation_orders using (id)
				group by product_variations.id        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
        	drop view if exist product_variation_stock_view
        ");
    }
}
