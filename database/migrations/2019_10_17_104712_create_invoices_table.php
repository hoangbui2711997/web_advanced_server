<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->decimal('service_fee', 30, 5);
			$table->decimal('amount', 30, 5);
			$table->timestamp('delivery_date');
			$table->string('instruction');
			$table->string('status');

			$table->unsignedBigInteger('employee_id')->nullable();
			$table->unsignedBigInteger('branch_id')->nullable();
			$table->unsignedBigInteger('discount_id')->nullable();
			$table->unsignedBigInteger('address_book_id')->nullable();
			$table->unsignedBigInteger('note_id')->nullable();
            $table->timestamps();

			$table->foreign('employee_id')->references('id')->on('users');
			$table->foreign('discount_id')->references('id')->on('discounts');
			$table->foreign('branch_id')->references('id')->on('branches');
			$table->foreign('note_id')->references('id')->on('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
