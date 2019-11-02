<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->tinyInteger('gender');
			$table->dateTime('birth_day');
			$table->tinyInteger('age');
			$table->integer('point_available');

			$table->bigInteger('zipcode_id')->unsigned();
			$table->bigInteger('marital_status_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
            $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('marital_status_id')->references('id')->on('marital_statuses');
			$table->foreign('zipcode_id')->references('id')->on('zip_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
