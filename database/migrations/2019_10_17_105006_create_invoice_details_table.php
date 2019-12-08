<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->decimal('amount', 30, 2);

			$table->unsignedBigInteger('invoice_id')->nullable();
			$table->unsignedBigInteger('product_in_cart_id')->nullable();

			$table->foreign('invoice_id')->references('id')->on('invoices');
			$table->foreign('product_in_cart_id')->references('id')->on('product_in_carts');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
