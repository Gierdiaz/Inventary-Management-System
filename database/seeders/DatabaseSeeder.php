<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            ProfileTableSeeder::class,
            UserTableSeeder::class,
            SupplierTableSeeder::class,
            CategoryTableSeeder::class,
            ProductTableSeeder::class,
            StockMovementTableSeeder::class,
        ]);
    }
}
