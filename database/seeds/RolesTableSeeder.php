<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::truncate();

        Role::create(['name' => 'admin', 'slug' => 'admin']);
        Role::create(['name' => 'author', 'slug' => 'author']);
        Role::create(['name' => 'user', 'slug' => 'user']);
    }
}
