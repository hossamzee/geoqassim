<?php

class PagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // About.
        // 1.
        Page::create([
          'slug' => 'about',
          'title' => 'About',
        ]);

        // Master.
        // 2.
        Page::create([
          'slug' => 'master',
          'title' => 'Master',
        ]);

        // WRAJ.
        // 3.
        Page::create([
          'slug' => 'wraj',
          'title' => 'WRAJ',
        ]);

        // Services.
        // 4
        Page::create([
          'slug' => 'services',
          'title' => 'Services',
        ]);

        // Maps.
        // 5
        Page::create([
          'slug' => 'maps',
          'title' => 'Maps',
        ]);
    }

}
