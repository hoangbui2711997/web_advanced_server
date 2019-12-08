<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vases', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('image_url', 2000);
			$table->string('name');
			$table->text('description');
			$table->decimal('price_base', 30);
			$table->decimal('price', 30);
			$table->timestamp('special_from')->default(now());
			$table->timestamp('special_to')->default(now());
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
        Schema::dropIfExists('vases');
    }
}
