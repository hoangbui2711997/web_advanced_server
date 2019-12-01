<?php

namespace App\Console\Commands;

use App\Consts;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserRole;
use Illuminate\Console\Command;

class MigrateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	// create user
		for ($i = 0; $i < 10; $i++) {
			$user = factory(UserInfo::class)->create();
			UserRole::insert([
				'user_id' => $user->user_id,
				'role_id' => Consts::$ROLE_USER
			]);
		}
		// create employee
		for ($i = 0; $i < 10; $i++) {
			$user = factory(UserInfo::class)->create();
			UserRole::insert([
				[
					'user_id' => $user->user_id,
					'role_id' => Consts::$ROLE_EMPLOYEE
				]
			]);
		}
		// create employee, user
		for ($i = 0; $i < 10; $i++) {
			$user = factory(UserInfo::class)->create();
			UserRole::insert([
				[
					'user_id' => $user->user_id,
					'role_id' => Consts::$ROLE_USER
				],
				[
					'user_id' => $user->user_id,
					'role_id' => Consts::$ROLE_EMPLOYEE
				]
			]);
		}

		// create employee, user, manager
		for ($i = 0; $i < 10; $i++) {
			$user = factory(UserInfo::class)->create();
			UserRole::insert([
				[
					'user_id' => $user->user_id,
					'role_id' => Consts::$ROLE_USER
				],
				[
					'user_id' => $user->user_id,
					'role_id' => Consts::$ROLE_EMPLOYEE
				],
				[
					'user_id' => $user->user_id,
					'role_id' => Consts::$ROLE_MANAGER
				]
			]);
		}
    }
}
