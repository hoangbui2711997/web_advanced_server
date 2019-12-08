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
			$table->dateTime('birth_day')->nullable();
			$table->tinyInteger('age');
			$table->integer('point_available');
			$table->string('phone_number')->nullable();
			$table->unsignedBigInteger('address_id')->nullable();
			$table->unsignedBigInteger('marital_status_id')->nullable();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('branch_id')->nullable();
            $table->timestamps();

			$table->foreign('branch_id')->references('id')->on('branches');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('marital_status_id')->references('id')->on('marital_statuses');
			$table->foreign('address_id')->references('id')->on('addresses');
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
