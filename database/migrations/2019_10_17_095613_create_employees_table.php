<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->tinyInteger('age')->unsigned()->nullable();
			$table->date('birth_day')->nullable();
			$table->string('phone_number')->nullable();

			$table->bigInteger('branch_id')->unsigned();
			$table->bigInteger('address_id')->unsigned();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
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
        Schema::dropIfExists('employees');
    }
}
