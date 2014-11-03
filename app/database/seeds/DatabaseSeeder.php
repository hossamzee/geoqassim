<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Ungarde the fields to fulfill them directly.
		Eloquent::unguard();

		// Start calling the seeds.
		$this->call('NewsTableSeeder');
	}

}
