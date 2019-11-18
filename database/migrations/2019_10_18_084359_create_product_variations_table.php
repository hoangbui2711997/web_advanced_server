<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->text('description');
			$table->string('color');
			$table->string('image_url', 2000);
			$table->string('type');
			$table->decimal('rate', 2, 1)->default(0);
			$table->integer('rate_amount')->unsigned()->default(0);
			$table->decimal('price_base', 30);
			$table->decimal('price', 30);
			$table->timestamp('special_from')->default(now());
			$table->timestamp('special_to')->default(now());
			$table->integer('amount_in_stock')->unsigned()->default(0);

			$table->bigInteger('product_id')->unsigned();
			$table->bigInteger('vase_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('vase_id')->references('id')->on('vases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
