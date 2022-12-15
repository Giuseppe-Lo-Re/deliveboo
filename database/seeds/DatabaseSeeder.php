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
        $this->call(UserCategorySeederTable::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        
        // seeder per la presentazione
        $this->call(PresentationUsersTableSeeder::class);
        $this->call(PresentationProductsTableSeeder::class);
        $this->call(PresentationOrdersTableSeeder::class);
    }
}
