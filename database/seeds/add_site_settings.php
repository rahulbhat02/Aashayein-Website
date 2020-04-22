<?php

use Illuminate\Database\Seeder;

class add_site_settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->insert([
            'website_name' => '',
            'website_email' => Str::random(10).'@gmail.com',
            'insta_link' => 'https://www.instagram.com',
        ]);
    }
}
