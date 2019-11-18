<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleControl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_controls', function (Blueprint $table) {
			$table->unsignedBigInteger('role_id');
			$table->unsignedBigInteger('control_id');
			$table->timestamps();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
			$table->foreign('control_id')->references('id')->on('controls')->onDelete('cascade');
			$table->primary(['role_id', 'control_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_controls');
    }
}
