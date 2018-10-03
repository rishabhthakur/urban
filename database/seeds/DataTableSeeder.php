<?php

use Illuminate\Database\Seeder;
use Urban\Adata;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('adatas')->delete();

        $data = [
            [
                'id' => 1,
                'name' => 'Red',
                'slug' => 'red',
                'attrb_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Black',
                'slug' => 'black',
                'attrb_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Blue',
                'slug' => 'blue',
                'attrb_id' => 1
            ],
            [
                'id' => 4,
                'name' => 'S',
                'slug' => 's',
                'attrb_id' => 2
            ],
            [
                'id' => 5,
                'name' => 'M',
                'slug' => 'm',
                'attrb_id' => 2
            ],
            [
                'id' => 6,
                'name' => 'L',
                'slug' => 'l',
                'attrb_id' => 2
            ],
            [
                'id' => 7,
                'name' => 'XL',
                'slug' => 'xl',
                'attrb_id' => 2
            ]
        ];

        foreach($data as $dat){
            Adata::create($dat);
        }
    }
}
