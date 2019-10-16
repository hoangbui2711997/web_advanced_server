<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryShippingMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_shipping_method', function (Blueprint $table) {
            $table->bigInteger('shipping_method_id')->unsigned()->index();
            $table->bigInteger('country_id')->unsigned()->index();

			$table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
			$table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('country_shipping_method');
    }
}
