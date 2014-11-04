<?php

class NewsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
          'title' => 'My first news',
          'content' => 'This is the first news to be added.',
        ]);

    }

}
