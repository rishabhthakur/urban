<?php

use Urban\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('brands')->delete();

        $brands = [
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

        foreach($brands as $brand){
            Brand::create($brand);
        }
    }
}
