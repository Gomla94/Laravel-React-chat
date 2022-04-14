<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'type' => 'admin',
            'unique_id' => str_random(60)
        ]);

        User::create([
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
            'type' => 'user',
            'unique_id' => str_random(60)
        ]);

        User::create([
            'name' => 'Mohamed',
            'email' => 'mohamed@example.com',
            'password' => Hash::make('password'),
            'type' => 'user',
            'unique_id' => str_random(60)
        ]);

    }
}
