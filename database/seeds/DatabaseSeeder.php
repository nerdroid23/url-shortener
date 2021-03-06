<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'john doe',
            'email' => 'jdoe@mail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);
//         $this->call(UserSeeder::class);
    }
}
