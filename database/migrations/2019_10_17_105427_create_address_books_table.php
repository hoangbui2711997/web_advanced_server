<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_books', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->string('first_name');
			$table->string('last_name');
			$table->string('address_line_1');
			$table->string('address_line_2');
			$table->string('phone_number');
			$table->string('email');

			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('location_type_id')->nullable();
			$table->unsignedBigInteger('zipcode_id')->nullable();
            $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('location_type_id')->references('id')->on('location_types')->onDelete('cascade');
			$table->foreign('zipcode_id')->references('id')->on('zip_codes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_books');
    }
}
