<?php

use Illuminate\Database\Seeder;

use Urban\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('tags')->delete();

        $tags = [
            [
                'id' => 1,
                'name' => 'Nike',
                'slug' => 'nike',
                'belongs_to' => 'product'
            ],
            [
                'id' => 2,
                'name' => 'H&M',
                'slug' => 'h&m',
                'belongs_to' => 'product'
            ],
            [
                'id' => 3,
                'name' => 'Gucci',
                'slug' => 'gucci',
                'belongs_to' => 'product'
            ],
            [
                'id' => 4,
                'name' => 'Levi',
                'slug' => 'levi',
                'belongs_to' => 'product'
            ],
            [
                'id' => 5,
                'name' => 'business',
                'slug' => 'business',
                'belongs_to' => 'post'
            ],
            [
                'id' => 6,
                'name' => 'fashion',
                'slug' => 'fashion',
                'belongs_to' => 'post'
            ],
            [
                'id' => 7,
                'name' => 'books',
                'slug' => 'books',
                'belongs_to' => 'post'
            ],
            [
                'id' => 8,
                'name' => 'javascript',
                'slug' => 'javascript',
                'belongs_to' => 'post'
            ]
        ];

        foreach($tags as $tag){
            Tag::create($tag);
        }
    }
}
