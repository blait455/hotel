<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name' => 'standard', 'slug' => 'standard']);
        Type::create(['name' => 'deluxe', 'slug' => 'deluxe']);
        Type::create(['name' => 'suite', 'slug' => 'suite']);

    }
}
