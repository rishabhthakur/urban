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

        App\Settings::create([
            'site_name' => 'Fabraco',
            'tagline' => 'Beta is Latin for still doesn\'t work',
            'author' => 'Thavarshan',
            'description' => 'Cum ceteris in veneratione tui montes, nascetur mus. Praeterea iter est quasdam res quas ex communi. Donec sed odio operae, eu vulputate felis rhoncus.',
            'email' => 'tjthavrashan@gmail.com',
            'copyright_text' => 'Copyright © 2018 Fabraco. All rights reserved'
        ]);
    }
}
