<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variation_order', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_variation_id')->unsigned();
            $table->decimal('quantity', 10, 2);
            $table->timestamps();

            $table->primary(['order_id', 'product_variation_id']);
            $table->foreign('order_id')
				->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_variation_id')
				->references('id')->on('product_variations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variation_order');
    }
}
