<?php

namespace App\Repositories;

use App\Contracts\StockMovementRepositoryInterface;
use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Collection;

class StockMovementRepository implements StockMovementRepositoryInterface
{
    protected $model;

    public function __construct(StockMovement $stockMovementModel)
    {
        $this->model = $stockMovementModel;
    }

    public function getStockMovements(): Collection
    {
        return $this->model->with('product')->get();
    }

    public function getStockMovementById(int $id): StockMovement
    {
        return $this->model->with('product')->findOrFail($id);
    }

    public function createStockMovement(array $data): StockMovement
    {
        return $this->model->create($data);
    }

    public function updateStockMovement(StockMovement $stockMovement, array $data): bool
    {
        return $this->model->where('id', $stockMovement->id)->update($data);
    }

    public function deleteStockMovement(StockMovement $stockMovement): bool
    {
        return $this->model->where('id', $stockMovement->id)->delete();
    }
}
