<?php

namespace App\Http\Controllers;

use App\Contracts\StockMovementRepositoryInterface;
use App\Http\Requests\StockMovementFormRequest;
use App\Http\Resources\StockMovementResource;
use Exception;
use Illuminate\Http\{JsonResponse, Response};
use Illuminate\Support\Facades\{DB, Log};

class StockMovementController extends Controller
{
    protected $stockMovementRepository;

    public function __construct(StockMovementRepositoryInterface $stockMovementRepository)
    {
        $this->stockMovementRepository = $stockMovementRepository;
    }

    public function index(): JsonResponse
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

    public function show($id): JsonResponse
    {
        try {
            $stockMovement = $this->stockMovementRepository->getStockMovementById($id);

            if (is_null($stockMovement)) {
                return response()->json(['Message' => 'Stock movement not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['Stock Movement' => StockMovementResource::make($stockMovement)], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StockMovementFormRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $validated = $request->validated();

            $stockMovement = $this->stockMovementRepository->createStockMovement($validated);

            DB::commit();

            Log::channel('stockMovements')->info('Stock Movement created successfully', ['stockMovement', $stockMovement->toArray()]);

            return response()->json(['Stock Movement' => StockMovementResource::make($stockMovement)], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('stockMovements')->error('An error occurred while creating a stock movement', ['message' => $exception->getMessage(), 'trace' => $exception->getTrace()]);

            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(StockMovementFormRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            $validated = $request->validated();

            $stockMovement = $this->stockMovementRepository->getStockMovementById($id);

            if (is_null($stockMovement)) {
                return response()->json(['Message' => 'Stock movement not found'], Response::HTTP_NOT_FOUND);
            }

            $this->stockMovementRepository->updateStockMovement($stockMovement, $validated);

            DB::commit();

            Log::channel('stockMovements')->info('Stock Movement updated successfully', ['stockMovement', $stockMovement->toArray()]);

            return response()->json(['Stock Movement' => StockMovementResource::make($stockMovement)], Response::HTTP_OK);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('stockMovements')->error('An error occurred while updating a stock movement', ['message' => $exception->getMessage(), 'trace' => $exception->getTrace()]);

            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id): JsonResponse
    {
        try {

            $stockMovement = $this->stockMovementRepository->getStockMovementById($id);

            if (is_null($stockMovement)) {
                return response()->json(['Message' => 'Stock movement not found'], Response::HTTP_NOT_FOUND);
            }

            $this->stockMovementRepository->deleteStockMovement($stockMovement);

            return response()->json(['Message' => 'Stock Movement deleted successfully'], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
