<?php

class VideosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
          'url' => 'http://www.youtube.com/watch?v=TqKWrLO0_5s',
          'title' => 'THE APPLE STORY in MOTION DESIGN',
          'description' => 'From the beginning of Apple Computing in 1976 to the release of the Iphone 5 in 2012, the firm headquartered in Cupertino has had a fascinating and unique history.',
        ]);

    }

}
