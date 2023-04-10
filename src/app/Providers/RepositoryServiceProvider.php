<?php

namespace App\Providers;

use App\Repositories\CategoryCacheRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryWriteRepository;
use App\Repositories\CategoryWriteRepositoryInterface;
use App\Repositories\ProductCacheRepository;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryCacheRepository::class);
        $this->app->bind(CategoryWriteRepositoryInterface::class, CategoryWriteRepository::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductCacheRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
