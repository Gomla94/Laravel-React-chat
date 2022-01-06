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
            'type' => 'admin'
        ]);

        User::create([
            'name' => 'adminApp',
            'email' => 'adminApp@example.com',
            'password' => Hash::make('password'),
            'type' => 'admin',
            'country_id' => 2
        ]);
    }
}
