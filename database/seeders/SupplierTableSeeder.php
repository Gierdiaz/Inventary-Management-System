<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Supplier::create([
            'name'    => 'Fornecedor A',
            'contact' => 'Allison Luis',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorA@example.com',
            'address' => 'Rua Olinto, 112',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor B',
            'contact' => 'José Carlos',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorB@example.com',
            'address' => 'José Machado, 845',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor Q',
            'contact' => 'Marcos Silva',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorQ@example.com',
            'address' => 'Praça Modelo, 789',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor R',
            'contact' => 'Amanda Oliveira',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorR@example.com',
            'address' => 'Rua Principal, 123',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor S',
            'contact' => 'Josué Santos',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorS@example.com',
            'address' => 'Avenida Secundária, 456',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor T',
            'contact' => 'Carolina Silva',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorT@example.com',
            'address' => 'Praça Central, 789',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor U',
            'contact' => 'Raphael Oliveira',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorU@example.com',
            'address' => 'Rua Central, 123',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor V',
            'contact' => 'Vanessa Santos',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorV@example.com',
            'address' => 'Avenida Principal, 456',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor W',
            'contact' => 'Gabriel Silva',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorW@example.com',
            'address' => 'Praça Secundária, 789',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor X',
            'contact' => 'Larissa Oliveira',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorX@example.com',
            'address' => 'Rua Modelo, 123',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor Y',
            'contact' => 'Diego Santos',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorY@example.com',
            'address' => 'Avenida Teste, 456',
        ]);

        Supplier::create([
            'name'    => 'Fornecedor Z',
            'contact' => 'Juliana Silva',
            'phone'   => '(XX) XXXX-XXXX',
            'email'   => 'fornecedorZ@example.com',
            'address' => 'Praça Exemplo, 789',
        ]);

    }
}
