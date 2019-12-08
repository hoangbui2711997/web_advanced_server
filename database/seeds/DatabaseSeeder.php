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
		$limit = 1400;
//		$limit = 14;
		factory(\App\Models\Product::class, $limit / 2)->create();
		factory(\App\Models\ProductVariation::class, $limit / 2 * 3)->create();

		factory(\App\Models\ProductExtra::class, $limit)->create();
		factory(\App\Models\ProductExtraVariation::class, $limit * 3)->create();
		factory(\App\Models\VaseVariation::class, $limit * 3)->create();
		factory(\App\Models\FlowerImage::class, $limit * 3 / 2 * 3)->create();
		// $this->call(UsersTableSeeder::class);
		DB::table('users')->insert([
			[
				'name' => 'Test',
				'email' => 'hoang2711997@gmail.com',
				'email_verified_at' => '',
				'password' => bcrypt('123123'),
				'active' => 1,
				'activation_token' => '',
				'avatar' => 'avatar.png',
			]
		]);
		DB::table('user_roles')->insert([
			'user_id' => \App\Models\User::where('email', 'hoang2711997@gmail.com')->first()->id,
			'role_id' => 1,
			'created_at' => now(),
			'updated_at' => now()
		]);
	}
}
