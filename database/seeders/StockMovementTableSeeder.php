<?php

namespace Database\Seeders;

use App\Models\StockMovement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockMovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockMovement::create([
            'product_id' => DB::table('products')->where('name', 'Oxímetro de Pulso')->value('id'),
            'quantity'   => 5,
            'type'       => 'entrada',
            'date'       => now(),
            'note'       => 'Recebimento de novo estoque.',
        ]);

        StockMovement::create([
            'product_id' => DB::table('products')->where('name', 'Bisturi Elétrico')->value('id'),
            'quantity'   => 3,
            'type'       => 'saida',
            'date'       => now(),
            'note'       => 'Venda para cliente X.',
        ]);

        StockMovement::create([
            'product_id' => DB::table('products')->where('name', 'Plataforma de Consultas Online')->value('id'),
            'quantity'   => 10,
            'type'       => 'entrada',
            'date'       => now(),
            'note'       => 'Recebimento de novo estoque.',
        ]);

        StockMovement::create([
            'product_id' => DB::table('products')->where('name', 'Hemograma Completo')->value('id'),
            'quantity'   => 20,
            'type'       => 'saida',
            'date'       => now(),
            'note'       => 'Exames realizados para o hospital Y.',
        ]);
    }
}
