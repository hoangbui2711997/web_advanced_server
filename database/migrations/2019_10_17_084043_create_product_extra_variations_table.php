<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductExtraVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_extra_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount')->unsigned();
			$table->decimal('price_base', 30);
			$table->decimal('price', 30);
			$table->timestamp('special_from')->default(now());
			$table->timestamp('special_to')->default(now());
			$table->bigInteger('product_extra_id')->unsigned();
			$table->bigInteger('discount_id')->unsigned();
            $table->timestamps();

			$table->foreign('product_extra_id')->references('id')->on('product_extras');
			$table->foreign('discount_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_extra_variations');
    }
}
