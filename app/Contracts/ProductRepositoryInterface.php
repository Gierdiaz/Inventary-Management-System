<?php

namespace App\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getProducts(): Collection;

    public function getProductById(int $id): Product;

    public function createProduct(array $data): Product;

    public function updateProduct(Product $product, array $data): bool;

    public function deleteProduct(Product $product): bool;
}
