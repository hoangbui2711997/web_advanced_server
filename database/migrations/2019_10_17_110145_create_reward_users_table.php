<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_users', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('reward_id')->nullable();
			$table->unsignedInteger('point')->default(0);
			$table->string('status');
            $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('reward_id')->references('id')->on('reward_programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_users');
    }
}
