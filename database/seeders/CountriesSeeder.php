<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create(['name' => 'Egypt']);
        Country::create(['name' => 'Russia']);
        Country::create(['name' => 'Armenia']);
        Country::create(['name' => 'UK']);
        Country::create(['name' => 'USA']);
        Country::create(['name' => 'Canada']);
        Country::create(['name' => 'France']);
        Country::create(['name' => 'UAE']);
    }
}
