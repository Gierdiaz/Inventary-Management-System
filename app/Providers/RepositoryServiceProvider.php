<?php

namespace App\Providers;

use App\Contracts\{
    CategoryRepositoryInterface,
    ProductRepositoryInterface,
    SupplierRepositoryInterface,
    UserRepositoryInterface};

use App\Repositories\{
    CategoryRepository,
    ProductRepository,
    SupplierRepository,
    UserRepository};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
