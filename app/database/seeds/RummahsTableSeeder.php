<?php

class RummahsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rummah::create([
          'title' => 'Rummah 1',
          'version' => '2014',
          'description' => 'This is the first Rummah to be added.',
        ]);

    }

}
