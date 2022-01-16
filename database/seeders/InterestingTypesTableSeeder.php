<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interesting_types')->insert([
            [
                'id' => 1,
                'name' => 'Sport',
                'created_at' => now(),
                "updated_at" => now()
            ],
            [
                'id' => 2,
                'name' => 'IT',
                'created_at' => now(),
                "updated_at" => now()
            ],
            [
                'id' => 3,
                'name' => 'Sales',
                'created_at' => now(),
                "updated_at" => now()
            ],
            [
                'id' => 4,
                'name' => 'Tours',
                'created_at' => now(),
                "updated_at" => now()
            ],
            [
                'id' => 5,
                'name' => 'HoReCa',
                'created_at' => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
