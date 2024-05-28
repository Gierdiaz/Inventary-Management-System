<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Produtos para Equipamentos Médicos
        Product::create([
            'name'           => 'Oxímetro de Pulso',
            'description'    => 'Oxímetro de pulso portátil para medição da saturação de oxigênio no sangue.',
            'barcode'        => '6789012345678',
            'category_id'    => DB::table('categories')->where('name', 'Equipamentos Médicos')->value('id'), // Equipamentos Médicos
            'cost_price'     => 200.00,
            'sale_price'     => 350.00,
            'stock_quantity' => 8,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor Q')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Bisturi Elétrico',
            'description'    => 'Bisturi elétrico para procedimentos cirúrgicos precisos e seguros.',
            'barcode'        => '7890123456789',
            'category_id'    => DB::table('categories')->where('name', 'Equipamentos Médicos')->value('id'), // Equipamentos Médicos
            'cost_price'     => 3000.00,
            'sale_price'     => 4500.00,
            'stock_quantity' => 6,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor R')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Desfibrilador Manual',
            'description'    => 'Desfibrilador manual para uso em emergências cardíacas avançadas.',
            'barcode'        => '8901234567890',
            'category_id'    => DB::table('categories')->where('name', 'Equipamentos Médicos')->value('id'), // Equipamentos Médicos
            'cost_price'     => 5000.00,
            'sale_price'     => 7000.00,
            'stock_quantity' => 4,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor S')->value('id'), // Fornecedor
        ]);

        // Produtos para Telemedicina
        Product::create([
            'name'           => 'Plataforma de Consultas Online',
            'description'    => 'Plataforma web para consultas médicas virtuais com integração de vídeo e chat.',
            'barcode'        => '9012345678901',
            'category_id'    => DB::table('categories')->where('name', 'Telemedicina')->value('id'), // Telemedicina
            'cost_price'     => 1000.00,
            'sale_price'     => 1500.00,
            'stock_quantity' => 12,
            'unit'           => 'licença',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor T')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Termômetro Digital Sem Contato',
            'description'    => 'Termômetro digital infravermelho para medição de temperatura sem contato físico.',
            'barcode'        => '0123456789012',
            'category_id'    => DB::table('categories')->where('name', 'Telemedicina')->value('id'), // Telemedicina
            'cost_price'     => 50.00,
            'sale_price'     => 80.00,
            'stock_quantity' => 20,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor U')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Software de Telemedicina',
            'description'    => 'Software para gestão de consultas e prontuários médicos online.',
            'barcode'        => '1234567890123',
            'category_id'    => DB::table('categories')->where('name', 'Telemedicina')->value('id'), // Telemedicina
            'cost_price'     => 2000.00,
            'sale_price'     => 3500.00,
            'stock_quantity' => 5,
            'unit'           => 'licença',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor V')->value('id'), // Fornecedor
        ]);

        // Produtos para Exames
        Product::create([
            'name'           => 'Hemograma Completo',
            'description'    => 'Exame de hemograma completo para análise dos componentes sanguíneos.',
            'barcode'        => '2345678901234',
            'category_id'    => DB::table('categories')->where('name', 'Exames')->value('id'), // Exames
            'cost_price'     => 100.00,
            'sale_price'     => 150.00,
            'stock_quantity' => 30,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor W')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Ultrassonografia Abdominal',
            'description'    => 'Exame de ultrassonografia abdominal para diagnóstico de problemas internos.',
            'barcode'        => '3456789012345',
            'category_id'    => DB::table('categories')->where('name', 'Exames')->value('id'), // Exames
            'cost_price'     => 200.00,
            'sale_price'     => 300.00,
            'stock_quantity' => 25,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor X')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Ressonância Magnética',
            'description'    => 'Exame de ressonância magnética para avaliação detalhada de estruturas internas.',
            'barcode'        => '4567890123456',
            'category_id'    => DB::table('categories')->where('name', 'Exames')->value('id'), // Exames
            'cost_price'     => 500.00,
            'sale_price'     => 800.00,
            'stock_quantity' => 15,
            'unit'           => 'unidade',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor Y')->value('id'), // Fornecedor
        ]);

        // Produtos para Laudos
        Product::create([
            'name'           => 'Laudo de Radiografia de Tórax',
            'description'    => 'Laudo médico de radiografia de tórax para avaliação de condições pulmonares.',
            'barcode'        => '5678901234567',
            'category_id'    => DB::table('categories')->where('name', 'Laudos')->value('id'), // Laudos
            'cost_price'     => 20.00,
            'sale_price'     => 40.00,
            'stock_quantity' => 40,
            'unit'           => 'laudo',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor Z')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Laudo de Tomografia Computadorizada',
            'description'    => 'Laudo médico de tomografia computadorizada para diagnóstico de condições internas.',
            'barcode'        => '6789012345678',
            'category_id'    => DB::table('categories')->where('name', 'Laudos')->value('id'), // Laudos
            'cost_price'     => 30.00,
            'sale_price'     => 50.00,
            'stock_quantity' => 35,
            'unit'           => 'laudo',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor A')->value('id'), // Fornecedor
        ]);

        Product::create([
            'name'           => 'Laudo de Eletrocardiograma',
            'description'    => 'Laudo médico de eletrocardiograma para análise da atividade elétrica do coração.',
            'barcode'        => '7890123456789',
            'category_id'    => DB::table('categories')->where('name', 'Laudos')->value('id'), // Laudos
            'cost_price'     => 25.00,
            'sale_price'     => 45.00,
            'stock_quantity' => 25,
            'unit'           => 'laudo',
            'stock_min'      => 2,
            'supplier_id'    => DB::table('suppliers')->where('name', 'Fornecedor B')->value('id'), // Fornecedor
        ]);
    }
}
