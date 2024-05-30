<?php

namespace App\Http\Controllers;

use App\Contracts\ProductRepositoryInterface;
use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\{DB, Log};
use Inertia\Inertia;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // public function index()
    // {
    //     $products = Product::with(['supplier', 'category'])->get();

    //     return Inertia::render('Products/Index', [
    //         'products' => $products
    //     ]);
    // }

    public function index()
    {
        try {
            $products = $this->productRepository->getProducts();

            if ($products->isEmpty()) {
                return response()->json(['Message' => 'Products not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['Products' => ProductResource::collection($products)], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred. ' . $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        try {

            $product = $this->productRepository->getProductById($id);

            if (is_null($product)) {
                return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(['Product' => ProductResource::make($product)], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred: ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ProductFormRequest $request)
    {

        DB::beginTransaction();

        try {

            $validated = $request->validated();

            $product = $this->productRepository->createProduct($validated);

            DB::commit();

            Log::channel('products')->info('Product created successfully', ['product' => $product->toArray()]);

            return response()->json(['Product' => ProductResource::make($product)], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('products')->error('An unexpected error occurred durante product store: ', ['message' => $exception->getMessage(), 'trace' => $exception->getTrace()]);

            return response()->json(['Message' => 'An unexpected error occurred: ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    public function update(ProductFormRequest $request, $id)
    {

        DB::beginTransaction();

        try {
            $validated = $request->validated();

            $product = $this->productRepository->getProductById($id);

            $this->productRepository->updateProduct($product, $validated);

            DB::commit();

            Log::channel('products')->info('Product updated successfully:', ['id' => $id, 'data' => $validated]);

            return response()->json(['Product' => ProductResource::make($product)], Response::HTTP_OK);
        } catch (Exception $exception) {
            DB::rollBack();

            Log::channel('products')->error('An unexpected error occurred during product update: ', ['id' => $id, 'message' => $exception->getMessage(), 'trace' => $exception->getTrace()]);

            return response()->json(['Message' => 'An unexpected error occurred: ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {

            $product = $this->productRepository->getProductById($id);

            if (is_null($product)) {
                return response()->json(['Message' => 'Product not found'], Response::HTTP_NOT_FOUND);
            }

            $this->productRepository->deleteProduct($product);

            return response()->json(['Message' => 'Product deleted successfully'], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(['Message' => 'An unexpected error occurred: ' . $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
