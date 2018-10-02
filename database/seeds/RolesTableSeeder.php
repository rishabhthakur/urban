<?php

use Illuminate\Database\Seeder;
use Urban\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'id' => 1,
                'name' => 'Administrator'
            ],
            [
                'id' => 2,
                'name' => 'Moderator'
            ],
            [
                'id' => 3,
                'name' => 'Editor'
            ],
            [
                'id' => 4,
                'name' => 'Customer'
            ]
        ];

        foreach($roles as $role){
            Role::create($role);
        }
    }
}
