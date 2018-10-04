<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        Urban\Settings::create([
            'site_name' => 'URBAN',
            'tagline' => 'Beta is Latin for still doesn\'t work',
            'email' => Urban\User::where('admin', 1)->first()->email,

            'author' => Urban\User::where('admin', 1)->first()->name,
            'description' => 'Cum ceteris in veneratione tui montes, nascetur mus. Praeterea iter est quasdam res quas ex communi. Donec sed odio operae, eu vulputate felis rhoncus.',

            'copyright_text' => 'Copyright © 2018 URBAN. All rights reserved',

            'product_dir' => 1,
            'post_dir' => 2
        ]);
    }
}
