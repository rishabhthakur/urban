<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(LocalesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(DsettingsTableSeeder::class);
        $this->call(FileSystemsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(DataTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
    }
}
