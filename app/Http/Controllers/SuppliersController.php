<?php

namespace App\Http\Controllers;

use App\Contracts\SupplierRepositoryInterface;
use App\Http\Resources\SupplierResource;
use Exception;
use Illuminate\Http\{JsonResponse, Response};

class SuppliersController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index(): JsonResponse
    {
        try {
            $supplier = $this->supplierRepository->getSuppliers();

            if ($supplier->isEmpty()) {
                return response()->json([
                    'Message' => 'Suppliers not found',
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'Suppliers' => SupplierResource::collection($supplier),
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            response()->json([
                'Error'   => 'Internal Server Error',
                'Message' => 'An unexpected error occurred. ' . $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
