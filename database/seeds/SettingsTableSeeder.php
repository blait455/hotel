<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name'      =>  'Rohi Grand Suites',
            'email'     =>  'info@rohigrandsuites.com',
            'logo'      =>  'logo.png',
            'fav'      =>  'fav.png',
            'phone'     =>  '0321564987',
            'address'   =>  'No.10 GRA, Wukari Ini road, Taaba state, Nigeria',
            'footer'    =>  'RGS',
            'about'     =>  'Rohi grand suites is a luxury hotel in Wukari, Taraba state.',
            'facebook'  =>  'https://facebook.com',
            'twitter'  =>  'https://twiiter.com',
            'linkedin'  =>  'https://linkedin.com',
        ]);
    }
}
