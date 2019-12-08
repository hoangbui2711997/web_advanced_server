<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCollectionFlowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_collection_flowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('collection_flower_id');
			$table->unsignedBigInteger('product_id');
			$table->foreign('collection_flower_id')->references('id')->on('collection_flowers');
			$table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_collection_flowers');
    }
}
