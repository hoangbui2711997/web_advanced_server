<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$limit = 140;
    	factory(\App\Models\Product::class, $limit / 2)->create();
		factory(\App\Models\ProductVariation::class, $limit / 2 * 3)->create();

		factory(\App\Models\ProductExtra::class, $limit)->create();
		factory(\App\Models\ProductExtraVariation::class, $limit * 3)->create();
		factory(\App\Models\VaseVariation::class, $limit * 3)->create();
		factory(\App\Models\FlowerImage::class, $limit * 3 / 2 * 3)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
