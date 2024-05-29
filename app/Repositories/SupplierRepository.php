<?php

namespace App\Repositories;

use App\Contracts\SupplierRepositoryInterface;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository implements SupplierRepositoryInterface
{
    protected $model;

    public function __construct(Supplier $supplierModel)
    {
        $this->model = $supplierModel;
    }

    public function getSuppliers(): Collection
    {
        return $this->model->all();
    }

    public function getSupplierById(int $id): ?Supplier
    {
        return $this->model->findOrFail($id);
    }

    public function createSupplier(array $data): Supplier
    {
        return $this->model->create($data);
    }

    public function updateSupplier(Supplier $supplier, array $data): bool
    {
        return $this->model->where('id', $supplier->id)->update($data);
    }

    public function deleteSupplier(Supplier $supplier): bool
    {
        return $this->model->where('id', $supplier->id)->delete();
    }
}
