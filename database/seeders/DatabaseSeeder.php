<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UsersTableSeeder::class,
            ProvidersTableSeeder::class,
            CategoriesTableSeeder::class,
            CustomersTableSeeder::class,
            LocationsTableSeeder::class,
            ProductsTableSeeder::class,
            PurchaseDetailsTableSeeder::class,
            PurchaseOrdersTableSeeder::class,
            WarehousesTableSeeder::class,
            InventoriesTableSeeder::class,
            SalesDetailsTableSeeder::class,
            SalesTableSeeder::class,
            StockPriceTableSeeder::class,
            
        ]);

    }
}
