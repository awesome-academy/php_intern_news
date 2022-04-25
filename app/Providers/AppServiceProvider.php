<?php

namespace App\Providers;

use App\Models\Category;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
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
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //share to all view
        view()->composer([
            'guest.layout.master',
            'admin.category.index',
            'admin.category.edit'
        ], function ($view) {
            $categories = Category::with('subCategories')
                ->where('parent_id', 0)->get();
            $view->with('categories', $categories);
        });
        //define gate for article
        Gate::define('retrieve-article', function ($user, $article) {
            return $user->id == $article->author_id;
        });
    }
}
