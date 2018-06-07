<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'admin'=>1
        ]);
    }
}
