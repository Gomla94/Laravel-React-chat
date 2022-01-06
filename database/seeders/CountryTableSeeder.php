<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name' => "Armenia"],
            ['name' => "Egypt"],
            ['name' => "Russia"],
            ['name' => "England"],
            ['name' => "France"],
        ]);
    }
}
