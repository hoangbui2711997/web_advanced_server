<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceEnteredDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_entered_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->decimal('price', 30);
			$table->unsignedInteger('quantity');
			$table->unsignedInteger('amount');
			$table->unsignedBigInteger('manufactory_id');

			$table->unsignedBigInteger('invoice_entered_id');
            $table->timestamps();

			$table->foreign('invoice_entered_id')->references('id')->on('invoice_entereds');
			$table->foreign('manufactory_id')->references('id')->on('manufactories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_entered_details');
    }
}
