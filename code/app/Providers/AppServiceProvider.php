<?php

namespace App\Providers;

use App\Queries\AbstractQueryBuilder;
use App\Queries\QueryBuilderFactory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AuthorQueryBuilder::class);
        $this->app->bind(CategoryQueryBuilder::class);
        $this->app->bind(NewsQueryBuilder::class);
        $this->app->bind(AbstractQueryBuilder::class);
        $this->app->bind(QueryBuilderFactory::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
