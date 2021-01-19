<?php

use App\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::create(['name' => 'Ceiling fan', 'slug' => 'ceiling-fan']);
        Feature::create(['name' => 'AC', 'slug' => 'ac']);
        Feature::create(['name' => 'Standing fan', 'slug' => 'standing-fan']);
        Feature::create(['name' => 'Bath tub', 'slug' => 'bath-tub']);
        Feature::create(['name' => 'Shower', 'slug' => 'shower']);
        Feature::create(['name' => 'Television', 'slug' => 'television']);
    }
}
