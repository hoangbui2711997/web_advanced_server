<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailProductInCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_product_in_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_in_cart_id');
            $table->unsignedBigInteger('detail_morph_id');
            $table->string('detail_morph_type');
            $table->string('decoration_field');
			$table->foreign('product_in_cart_id')->references('id')->on('product_in_carts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_product_in_carts');
    }
}
