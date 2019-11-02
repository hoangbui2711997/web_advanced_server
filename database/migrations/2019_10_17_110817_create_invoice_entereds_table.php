<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceEnteredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_entereds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_import');
			$table->unsignedBigInteger('employee_id');
			$table->unsignedBigInteger('stock_id');
            $table->timestamps();

			$table->foreign('employee_id')->references('id')->on('employees');
			$table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_entereds');
    }
}
