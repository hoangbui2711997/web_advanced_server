<?php

namespace App\Console\Commands;

use App\Consts;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Console\Command;

class MigrateSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:salary';

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
		$users = User::join('user_roles', 'users.id', 'user_roles.user_id')
			->join('roles', 'roles.id', 'user_roles.role_id')
			->where('role_id', '<>', Consts::$ROLE_USER)
			->where('role_id', '<>', Consts::$ROLE_ADMIN)
			->select('users.*')
			->distinct('users.id')
			->get();
		$users->each(function ($user) {
			factory(Salary::class)->create(['employee_id' => $user->id]);
		});
    }
}
