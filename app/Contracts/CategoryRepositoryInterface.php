<?php

namespace App\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getCategories(): Collection;

    public function getCategoryById(int $id): Category;

    public function createCategory(array $data): Category;

    public function updateCategory(Category $category, array $data): bool;

    public function deleteCategory(Category $category): bool;
}
