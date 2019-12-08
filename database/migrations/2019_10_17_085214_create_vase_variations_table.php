<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaseVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vase_variations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('image_url', 2000);
			$table->string('size');
			$table->decimal('price_base', 30);
			$table->decimal('price', 30);
			$table->timestamp('special_from')->default(now());
			$table->timestamp('special_to')->default(now());
			$table->bigInteger('vase_id')->unsigned();
			$table->timestamps();

			$table->foreign('vase_id')->references('id')->on('vases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vase_variations');
    }
}
