<?php

use App\Scategory;
use Illuminate\Database\Seeder;

class ScategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('scategories')->delete();

        $categories = [
            [
                'id' => 1,
                'name' => 'Men',
                'slug' => 'men',
                'parent_id' => 0
            ],
            [
                'id' => 2,
                'name' => 'Women',
                'slug' => 'women',
                'parent_id' => 0
            ],
            [
                'id' => 3,
                'name' => 'Children',
                'slug' => 'children',
                'parent_id' => 0
            ],
            [
                'id' => 4,
                'name' => 'Jackets',
                'slug' => 'jackets',
                'parent_id' => 1
            ],
            [
                'id' => 5,
                'name' => 'Skirts',
                'slug' => 'skirts',
                'parent_id' => 2
            ],
            [
                'id' => 6,
                'name' => 'Hoodies',
                'slug' => 'shirts',
                'parent_id' => 3
            ],
            [
                'id' => 7,
                'name' => 'Hats',
                'slug' => 'hats',
                'parent_id' => 2
            ]
        ];

        foreach($categories as $category){
            Scategory::create($category);
        }
    }
}
