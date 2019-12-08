<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handle_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('amount');
            $table->text('description');
			$table->unsignedBigInteger('stock_id')->nullable();
			$table->unsignedBigInteger('product_variation_id')->nullable();
            $table->timestamps();

			$table->foreign('stock_id')->references('id')->on('stocks');
			$table->foreign('product_variation_id')->references('id')->on('product_variations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('handle_products');
    }
}
