<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_extras', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->unsignedBigInteger('product_id')->nullable();
			$table->bigInteger('unit_id')->unsigned();
            $table->timestamps();

			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_extras');
    }
}
