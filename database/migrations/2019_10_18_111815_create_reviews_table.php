<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('header');
			$table->text('content');
			$table->unsignedTinyInteger('rate');

			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('product_variation_id');
            $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reviews');
    }
}
