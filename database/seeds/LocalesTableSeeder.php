<?php

use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run() {
         DB::table('locales')->delete();

         $locales = [
                [
                    'name' => 'Afrikaans',
                    'code' => 'af'
                ],
                [
                    'name' => 'Akan',
                    'code' => 'ak'
                ],
                [
                    'name' => 'Albanian',
                    'code' => 'sq'
                ],
                [
                    'name' => 'Amharic',
                    'code' => 'am'
                ],
                [
                    'name' => 'Arabic',
                    'code' => 'ar'
                ],
                [
                    'name' => 'Armenian',
                    'code' => 'hy'
                ],
                [
                    'name' => 'Aromanian',
                    'code' => 'rup_MK'
                ],
                [
                    'name' => 'Assamese',
                    'code' => 'as'
                ],
                [
                    'name' => 'Azerbaijani',
                    'code' => 'az'
                ],
                [
                    'name' => 'Azerbaijani (Turkey)',
                    'code' => 'az_TR'
                ],
                [
                    'name' => 'Bashkir',
                    'code' => 'ba'
                ],
                [
                    'name' => 'Basque',
                    'code' => 'eu'
                ],
                [
                    'name' => 'Belarusian',
                    'code' => 'bel'
                ],
                [
                    'name' => 'Belarusian',
                    'code' => 'bel'
                ],
                [
                    'name' => 'Bengali',
                    'code' => 'bn_BD'
                ],
                [
                    'name' => 'Bosnian',
                    'code' => 'bs_BA'
                ],
                [
                    'name' => 'Bulgarian',
                    'code' => 'bg_BG'
                ],
                [
                    'name' => 'Burmese',
                    'code' => 'my_MM'
                ],
                [
                    'name' => 'Catalan',
                    'code' => 'ca'
                ],
                [
                    'name' => 'Chinese (China)',
                    'code' => 'zh_CN'
                ],
                [
                    'name' => 'Chinese (China)',
                    'code' => 'zh_CN'
                ],
                [
                    'name' => 'Croatian',
                    'code' => 'hr'
                ],
                [
                    'name' => 'Czech',
                    'code' => 'cs_CZ'
                ],
                [
                    'name' => 'Danish',
                    'code' => 'da_DK'
                ],
                [
                    'name' => 'Dutch',
                    'code' => 'nl_NL'
                ],
                [
                    'name' => 'English',
                    'code' => 'en_US'
                ],
                [
                    'name' => 'English (Australia)',
                    'code' => 'en_AU'
                ],
                [
                    'name' => 'English (Canada)',
                    'code' => 'en_CA'
                ],
                [
                    'name' => 'English (UK)',
                    'code' => 'en_GB'
                ]
         ];

        foreach($locales as $locale) {
            DB::table('locales')->insert($locale);
        }
     }
}
