<?php

namespace App\Http\Controllers;

use App\Contracts\SupplierRepositoryInterface;
use App\Http\Requests\SupplierFormRequest;
use App\Http\Resources\SupplierResource;
use Exception;
use Illuminate\Http\{JsonResponse, Response};
use Illuminate\Support\Facades\{DB, Log};

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
            $suppliers = $this->supplierRepository->getSuppliers();

            if ($suppliers->isEmpty()) {
                return response()->json(['Message' => 'Suppliers not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['Suppliers' => SupplierResource::collection($suppliers)], Response::HTTP_OK);
        } catch (Exception $exception) {
            response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $supplier = $this->supplierRepository->getSupplierById($id);

            if (is_null($supplier)) {
                return response()->json(['Message' => 'Supplier not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['Supplier' => SupplierResource::make($supplier)], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(SupplierFormRequest $request)
    {

        DB::beginTransaction();

        try {

            $validated = $request->validated();

            $supplier = $this->supplierRepository->createSupplier($validated);

            DB::commit();

            Log::channel('suppliers')->info('Supplier created successfully', ['supplier' => $supplier->toArray()]);

            return response()->json(['Message' => 'Supplier created successfully', 'Supplier' => SupplierResource::make($supplier)], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('suppliers')->error('An unexpected error occurred durante supplier store: ', ['message' => $exception->getTrace()]);

            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(SupplierFormRequest $request, $id)
    {

        DB::beginTransaction();

        try {
            $validated = $request->validated();

            $supplier = $this->supplierRepository->getSupplierById($id);

            $this->supplierRepository->updateSupplier($supplier, $validated);

            DB::commit();

            Log::channel('suppliers')->info('Supplier updated successfully', ['supplier' => $supplier->toArray()]);

            return response()->json(['Message' => 'Supplier updated successfully', 'Supplier' => SupplierResource::make($supplier)], Response::HTTP_OK);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('suppliers')->error('An unexpected error occurred during supplier update: ', ['message' => $exception->getTrace()]);

            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {

            $supplier = $this->supplierRepository->getSupplierById($id);

            $this->supplierRepository->deleteSupplier($supplier);

            return response()->json(['Message' => 'Supplier deleted successfully'], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
