<?php

namespace App\Console\Commands;

use App\Models\InvoiceDetail;
use Illuminate\Console\Command;

class MigrateInvoiceDetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:invoice-detail';

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
        factory(InvoiceDetail::class, 10000)->create();
    }
}
