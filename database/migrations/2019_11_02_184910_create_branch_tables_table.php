<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('object_reference_type');
            $table->string('object_reference_id');
			$table->unsignedInteger('amount');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('id_object');

            $table->timestamps();
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
        Schema::dropIfExists('branch_tables');
    }
}
