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
			$table->string('status');

			$table->unsignedBigInteger('employee_id')->nullable();
			$table->unsignedBigInteger('branch_id');
			$table->unsignedBigInteger('discount_id');
			$table->unsignedBigInteger('deliver_info_id')->nullable();
            $table->timestamps();

			$table->foreign('employee_id')->references('id')->on('employees');
			$table->foreign('discount_id')->references('id')->on('discounts');
			$table->foreign('deliver_info_id')->references('id')->on('deliver_infos');
			$table->foreign('branch_id')->references('id')->on('branches');
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
