<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //define gate for article
        Gate::define('retrieve-article', function ($user, $article) {
            return $user->id == $article->author_id;
        });
    }
}
