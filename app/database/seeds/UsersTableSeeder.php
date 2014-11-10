<?php

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'username' => 'admin',
          'password' => Hash::make('123'),
          'role' => 'admin',
        ]);

    }

}
