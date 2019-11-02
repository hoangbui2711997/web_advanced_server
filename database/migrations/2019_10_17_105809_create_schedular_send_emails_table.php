<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedularSendEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedular_send_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedTinyInteger('date');
			$table->unsignedTinyInteger('month');
			$table->text('content');

			$table->unsignedBigInteger('user_id');
            $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedular_send_emails');
    }
}
