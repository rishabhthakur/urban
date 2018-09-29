<?php

use Illuminate\Database\Seeder;
use App\Profile;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $user = App\User::create([
            'name' => 'Thavarshan',
            'email' => 'tjthavarshan@gmail.com',
            'password' => bcrypt('alpha26'),
            'slug' => str_slug('thavarshan'),
            'role_id' => 1,
            'admin' => 1,
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        if (!is_dir(public_path('uploads/avatar/'.strtolower($user->name)))) {
            mkdir(public_path('uploads/avatar/'.strtolower($user->name)));
        }

        $strg = storage_path('app/public/avatars/user.jpg');
        $publc = public_path('uploads/avatar/' .strtolower($user->name). '/user.jpg');
        copy($strg, $publc);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'user.jpg',
            'first_name' => 'Thavarshan',
            'last_name' => 'Thayananthajothy',
            'bio' => 'Any fool can use a computer. Many do.'
        ]);
    }
}
