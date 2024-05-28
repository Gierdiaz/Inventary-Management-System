<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $categoryModel)
    {
        $this->model = $categoryModel;
    }

    public function getCategories(): Collection
    {
        return $this->model->all();
    }

    public function getCategoryById($id): Category
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw new \Exception('Category not found');
        }

        return $category;
    }

    public function createCategory($data): Category
    {
        return $this->model->create($data);
    }

    public function updateCategory(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}
