<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(Users::class);
        $this->call(RolesAndPermissions::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(IngredientsInProductsTableSeeder::class);

        Model::reguard();
    }
}
