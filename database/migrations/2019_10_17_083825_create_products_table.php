<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('slug');
			$table->text('description');
			$table->string('image_url', 2000);
			$table->decimal('rate', 2, 1)->unsigned()->default(0);
			$table->integer('rate_amount')->unsigned()->default(0);
			$table->decimal('price_base', 30);
			$table->decimal('price', 30);
			$table->timestamp('special_from')->default(now());
			$table->timestamp('special_to')->default(now());
			$table->integer('amount_in_stock')->unsigned()->default(0);

			$table->bigInteger('discount_id')->unsigned();
			$table->bigInteger('category_id')->unsigned();
			$table->timestamps();

			$table->foreign('discount_id')->references('id')->on('discounts');
			$table->foreign('category_id')->references('id')->on('categories');
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
