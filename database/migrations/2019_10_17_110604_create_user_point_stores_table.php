<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_point_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedInteger('point')->default(0);

            $table->unsignedBigInteger('point_store_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->timestamps();

			$table->foreign('point_store_id')->references('id')->on('point_stores');
			$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_point_stores');
    }
}
