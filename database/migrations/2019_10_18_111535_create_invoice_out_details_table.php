<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_out_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('invoice_out_id')->nullable();
			$table->unsignedBigInteger('product_id')->nullable();
			$table->unsignedInteger('amount');
            $table->timestamps();

			$table->foreign('invoice_out_id')->references('id')->on('invoice_outs')->onDelete('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_out_details');
    }
}
