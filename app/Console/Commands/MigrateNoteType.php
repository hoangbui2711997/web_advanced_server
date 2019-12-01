<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateNoteType extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'custom:migrate:note_type';

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
		DB::table('note_types')->insert([
			['type' => 'Thanksgiving'],
			['type' => 'Birthday'],
			['type' => 'Anniversary'],
			['type' => 'Business Gift'],
			['type' => 'Congratulations'],
			['type' => 'Funeral'],
			['type' => 'Get Well'],
			['type' => 'Graduation'],
			['type' => 'Housewarming'],
			['type' => "I'm Sorry"],
			['type' => 'Just Because'],
			['type' => 'Love and Romance'],
			['type' => 'New Baby'],
			['type' => 'Retirement'],
			['type' => 'Sympathy'],
			['type' => 'Thank You'],
			['type' => 'Thinking of You'],
			['type' => 'Other']
		]);
	}
}
