<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigatorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('navigators', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('link', 1000)->default('');
			$table->string('icon')->nullable();
			$table->unsignedSmallInteger('order')->default(1);
			$table->foreign('parent_id')->references('id')->on('navigators');
			$table->string('title', 255);
			$table->smallInteger('level')->default(1);
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
		Schema::dropIfExists('navigators');
	}
}
