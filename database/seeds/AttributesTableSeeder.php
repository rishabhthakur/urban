<?php

use Illuminate\Database\Seeder;
use Urban\Attribute;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('attributes')->delete();

        $attributes = [
            [
                'id' => 1,
                'name' => 'Color',
                'slug' => 'color'
            ],
            [
                'id' => 2,
                'name' => 'Size',
                'slug' => 'size'
            ]
        ];

        foreach($attributes as $attribute){
            Attribute::create($attribute);
        }
    }
}
