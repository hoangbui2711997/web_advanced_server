<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_export');
			$table->unsignedBigInteger('employee_id')->nullable();
			$table->unsignedBigInteger('branch_id')->nullable();
			$table->unsignedBigInteger('invoice_entered_id')->nullable();
            $table->timestamps();

			$table->foreign('employee_id')->references('id')->on('users');
			$table->foreign('branch_id')->references('id')->on('branches');
			$table->foreign('invoice_entered_id')->references('id')->on('invoice_entereds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_outs');
    }
}
