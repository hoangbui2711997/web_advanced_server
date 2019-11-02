<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->boolean('receive_new_feed_email');
			$table->boolean('receive_loyalty_program_email');
			$table->boolean('receive_purchase');

            $table->timestamps();
			$table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscribers');
    }
}
