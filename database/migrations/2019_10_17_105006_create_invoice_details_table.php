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
			$table->string('type');
			$table->decimal('price');
			$table->unsignedSmallInteger('quantity');
			$table->decimal('amount', 30);

			$table->unsignedBigInteger('foreign_id');
			$table->unsignedBigInteger('invoice_id');
			$table->unsignedBigInteger('note_id');
			$table->unsignedBigInteger('discount_id');
            $table->timestamps();

			$table->foreign('invoice_id')->references('id')->on('invoices');
			$table->foreign('note_id')->references('id')->on('notes');
			$table->foreign('discount_id')->references('id')->on('discounts');
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
