<?php

namespace App\Contracts;

use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Collection;

interface StockMovementRepositoryInterface
{
    public function getStockMovements(): Collection;

    public function getStockMovementById(int $id): StockMovement;
}
