<?php

namespace App\Contracts;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

interface SupplierRepositoryInterface
{
    public function getSuppliers(): Collection;

    public function getSupplierById(int $id): ?Supplier;

    public function createSupplier(array $data): Supplier;

    public function updateSupplier(Supplier $supplier, array $data): bool;

    public function deleteSupplier(Supplier $supplier): bool;
}
