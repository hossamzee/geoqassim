<?php

class NewsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // TODO: Be careful with the following line.
        DB::table('news')->truncate();

        $faker = Faker\Factory::create('ar_JO');

        foreach (range(1, 20) as $index)
        {
            $slug = $faker->date($format = 'Y-m-d-', $max = 'now') . $faker->slug;

            News::create([
                'slug' => $slug,
                'title' => $faker->realText(100),
                'content' => $faker->realText(1500),
            ]);
        }

    }

}
