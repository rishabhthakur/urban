<?php

use App\Stag;
use Illuminate\Database\Seeder;

class StagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('stags')->delete();

        $tags = [
            [
                'id' => 1,
                'name' => 'Nike',
                'slug' => 'nike'
            ],
            [
                'id' => 2,
                'name' => 'H&M',
                'slug' => 'h&m'
            ],
            [
                'id' => 3,
                'name' => 'Gucci',
                'slug' => 'gucci'
            ],
            [
                'id' => 4,
                'name' => 'Levi',
                'slug' => 'levi'
            ]
        ];

        foreach($tags as $tag){
            Stag::create($tag);
        }
    }
}
