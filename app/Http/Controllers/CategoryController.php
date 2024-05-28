<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Resources\CategoryResource;
use Exception;
use Illuminate\Http\{JsonResponse, Response};
use Illuminate\Support\Facades\{DB};

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): JsonResponse
    {
        // Verifica se o usuário autenticado é admin
        // if (Auth::user()->role !== 'admin') {
        //     return response()->json([
        //         'Error' => 'Unauthorized',
        //         'Message' => 'You do not have permission to access this resource.'
        //     ], Response::HTTP_FORBIDDEN);
        // }

        try {
            $categories = $this->categoryRepository->getCategories();

            if ($categories->isEmpty()) {
                return response()->json([
                    'Error' => 'No categories found',
                ], response::HTTP_NOT_FOUND);
            };

            return response()->json([
                'categories' => CategoryResource::collection($categories),
            ], response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'Error'   => 'Internal Server Error',
                'Message' => 'An unexpected error occurred.' . $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $category = $this->categoryRepository->getCategoryById($id);

            if (!$category) {
                return response()->json([
                    'Error' => 'Category not found',
                ], Response::HTTP_NOT_FOUND);
            };

            return response()->json([
                'Category' => new CategoryResource($category),
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'Error'   => 'Internal Server Error',
                'Message' => 'An unexpected error occurred.' . $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CategoryFormRequest $request): JsonResponse
    {
        try {

            $validated = $request->validated();

            DB::beginTransaction();

            $category = $this->categoryRepository->createCategory($validated);

            DB::commit();

            return response()->json([
                'Category' => new CategoryResource($category),
            ], Response::HTTP_CREATED);
        } catch (Exception $exception) {

            DB::rollBack();

            return response()->json([
                'Error'   => 'Internal Server Error',
                'Message' => 'An unexpected error occurred.' . $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CategoryFormRequest $request, $id): JsonResponse
    {
        try {
            $validated = $request->validated();

            DB::beginTransaction();

            $category = $this->categoryRepository->getCategoryById($id);

            if (!$category) {
                return response()->json([
                    'Error' => 'Category not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $this->categoryRepository->updateCategory($category, $validated);
            DB::commit();

            return response()->json([
                'Category' => new CategoryResource($category),
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            DB::rollBack();

            return response()->json([
                'Error'   => 'Internal Server Error',
                'Message' => 'An unexpected error occurred.' . $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $category = $this->categoryRepository->getCategoryById($id);

            if (!$category) {
                return response()->json([
                    'Error' => 'Category not found',
                ], Response::HTTP_NOT_FOUND);
            }

            $this->categoryRepository->deleteCategory($category);

            return response()->json([
                'Message' => 'Category deleted successfully.',
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'Error'   => 'Internal Server Error',
                'Message' => 'An unexpected error occurred.' . $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
