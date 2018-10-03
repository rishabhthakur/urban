<?php

use Illuminate\Database\Seeder;

use Urban\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('categories')->delete();

        $categories = [
            [
                'id' => 1,
                'name' => 'Men',
                'slug' => 'men',
                'parent_id' => 0,
                'belongs_to' => 'product'
            ],
            [
                'id' => 2,
                'name' => 'Women',
                'slug' => 'women',
                'parent_id' => 0,
                'belongs_to' => 'product'
            ],
            [
                'id' => 3,
                'name' => 'Children',
                'slug' => 'children',
                'parent_id' => 0,
                'belongs_to' => 'product'
            ],
            [
                'id' => 4,
                'name' => 'Jackets',
                'slug' => 'jackets',
                'parent_id' => 1,
                'belongs_to' => 'product'
            ],
            [
                'id' => 5,
                'name' => 'Skirts',
                'slug' => 'skirts',
                'parent_id' => 2,
                'belongs_to' => 'product'
            ],
            [
                'id' => 6,
                'name' => 'Hoodies',
                'slug' => 'shirts',
                'parent_id' => 3,
                'belongs_to' => 'product'
            ],
            [
                'id' => 7,
                'name' => 'Hats',
                'slug' => 'hats',
                'parent_id' => 2,
                'belongs_to' => 'product'
            ],
            [
                'id' => 8,
                'name' => 'Business',
                'slug' => 'business',
                'parent_id' => 0,
                'belongs_to' => 'post'
            ],
            [
                'id' => 9,
                'name' => 'Fashion',
                'slug' => 'fashion',
                'parent_id' => 0,
                'belongs_to' => 'post'
            ],
            [
                'id' => 10,
                'name' => 'UI/UX',
                'slug' => 'ui-ux',
                'parent_id' => 0,
                'belongs_to' => 'post'
            ],
            [
                'id' => 11,
                'name' => 'Web Development',
                'slug' => 'web-development',
                'parent_id' => 0,
                'belongs_to' => 'post'
            ]
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
