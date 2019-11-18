<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_controls', function (Blueprint $table) {
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('control_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('control_id')->references('id')->on('controls')->onDelete('cascade');
            $table->primary(['user_id', 'control_id']);
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
        Schema::dropIfExists('user_controls');
    }
}
