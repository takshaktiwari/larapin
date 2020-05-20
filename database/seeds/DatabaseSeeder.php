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
        #$this->call(UsersTableSeeder::class);
        #$this->call(CountriesTableSeeder::class);
        #$this->call(AttributesTableSeeder::class);
        #$this->call(BrandsTableSeeder::class);
        #$this->call(CouponsTableSeeder::class);
        #$this->call(CategoriesTableSeeder::class);
        #$this->call(ProductsTableSeeder::class);
        #$this->call(ProductReviewsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
