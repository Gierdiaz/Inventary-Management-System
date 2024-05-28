<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Telemedicina',
        ]);

        Category::create([
            'name' => 'Equipamentos Médicos',
        ]);

        Category::create([
            'name' => 'Exames',
        ]);

        Category::create([
            'name' => 'Laudos',
        ]);
    }
}
