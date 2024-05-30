<?php

namespace App\Http\Controllers;

use App\Contracts\StockMovementRepositoryInterface;
use App\Http\Resources\StockMovementResource;
use Exception;
use Illuminate\Http\Response;

class StockMovementController extends Controller
{
    protected $stockMovementRepository;

    public function __construct(StockMovementRepositoryInterface $stockMovementRepository)
    {
        $this->stockMovementRepository = $stockMovementRepository;
    }

    public function index()
    {
        try {
            $stockMovements = $this->stockMovementRepository->getStockMovements();

            if ($stockMovements->isEmpty()) {
                return response()->json(['Message' => 'No stock movements found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['Stock Movements' => StockMovementResource::collection($stockMovements)], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
           $stockMovement = $this->stockMovementRepository->getStockMovementById($id);




           
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
