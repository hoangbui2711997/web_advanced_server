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
			$table->unsignedBigInteger('employee_id')->nullable();
			$table->unsignedBigInteger('stock_id')->nullable();
            $table->timestamps();

			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
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
