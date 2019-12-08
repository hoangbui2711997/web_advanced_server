<?php

namespace App\Console\Commands;

use App\Models\CollectionFlower;
use App\Models\ProductCollectionFlower;
use Illuminate\Console\Command;

class MigrateCollectionFlower extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:migrate:collection_flower';

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
        factory(CollectionFlower::class, 5)->create();
		factory(ProductCollectionFlower::class, 400)->create();
    }
}
