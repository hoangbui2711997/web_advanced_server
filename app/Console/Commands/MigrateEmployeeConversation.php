<?php

namespace App\Console\Commands;

use App\Models\EmployeeConversation;
use App\Models\UserConversation;
use Illuminate\Console\Command;

class MigrateEmployeeConversation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:employee_conversation';

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
		factory(EmployeeConversation::class, 10000)->create();
    }
}
