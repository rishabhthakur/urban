<?php

use Illuminate\Database\Seeder;

class FileSystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check for Uploads Directory
        if (!is_dir(public_path('uploads'))) {
            // Make Uploads Directory
            mkdir(public_path('uploads'));
        }

        // Make Products Directory
        if(!is_dir(public_path('uploads/products'))) {
            mkdir(public_path('uploads/products'));
        }

        // Make Posts Directory
        if(!is_dir(public_path('uploads/posts'))) {
            mkdir(public_path('uploads/posts'));
        }

        // Make Avatar Directory
        if(!is_dir(public_path('uploads/avatar'))) {
            mkdir(public_path('uploads/avatar'));
        }

        // Created Datatbase Entries of Each Directory
        DB::table('file_systems')->delete();

        $dirs = [
            [
                'id' => 1,
                'name' => 'products',
                'url' => asset('uploads/products'),
                'slug' => asset('uploads/products'),
                'path' => public_path('uploads/products')
            ],
            [
                'id' => 2,
                'name' => 'posts',
                'url' => asset('uploads/posts'),
                'slug' => asset('uploads/posts'),
                'path' => public_path('uploads/posts')
            ]
        ];

        foreach($dirs as $dir){
            Urban\FileSystem::create($dir);
        }

    }
}
