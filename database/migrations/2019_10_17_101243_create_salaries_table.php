<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->decimal('basic_salary', 30);
			$table->smallInteger('work_time');
			$table->smallInteger('work_over_time');
			$table->decimal('amount_salary');
			$table->dateTime('start_date');
			$table->dateTime('end_date');

			$table->unsignedBigInteger('employee_id');
            $table->timestamps();

			$table->foreign('employee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
