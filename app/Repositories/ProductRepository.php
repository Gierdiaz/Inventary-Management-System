<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $productModel)
    {
        $this->model = $productModel;
    }

    public function getProducts(): Collection
    {
        return $this->model->with(['supplier', 'category'])->get();
    }

    public function getProductById(int $id): Product
    {
        return $this->model->with(['supplier', 'category'])->findOrFail($id);
    }

    public function createProduct(array $data): Product
    {
        return $this->model->create($data);
    }

    public function updateProduct(Product $product, array $data): bool
    {
        return $this->model->where('id', $product->id)->update($data);
    }

    public function deleteProduct(Product $product): bool
    {
        return $this->model->where('id', $product->id)->delete();
    }
}
