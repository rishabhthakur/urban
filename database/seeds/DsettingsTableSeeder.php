<?php

use Illuminate\Database\Seeder;

class DsettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Urban\Dsettings::create([
            'discussion' => 1,
            'discussion_full' => 0,
            'discussion_auth' => 1,
            'auto_close_discussion' => 1,
            'discussion_email' => 0,
            'discussion_spam_email' => 0,
            'discussion_approve' => 1,
            'discussion_approve_once' => 0
        ]);
    }
}
