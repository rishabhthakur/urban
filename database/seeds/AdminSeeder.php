<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $user = Urban\User::create([
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

        Urban\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'user.jpg',
            'first_name' => 'Thavarshan',
            'last_name' => 'Thayananthajothy',
            'bio' => 'Any fool can use a computer. Many do.'
        ]);

        Urban\Address::create([
            'user_id' => $user->id,
            'type' => 'billing',
            'address1' => '44 Post Office Road',
            'town_city' => 'Trincomalee',
            'province_state' => 'Eastern Province',
            'postcode' => '31000',
            'country' => 'Sri Lanka',
            'phone' => '(+94) 77 501 8795'
        ]);

        Urban\Address::create([
            'user_id' => $user->id,
            'type' => 'shipping',
            'address1' => '59 Martin Road',
            'town_city' => 'Jaffna',
            'province_state' => 'Northern Province',
            'postcode' => '30000',
            'country' => 'Sri Lanka',
            'phone' => '(+94) 77 501 8795'
        ]);
    }
}
