<?php

use App\Http\Controllers\ArticleController as GuestArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('articles', User\ArticleController::class);
        Route::post('/articles/{id}/publish', [ArticleController::class, 'requestPublish'])
            ->name('articles.publish');
    });

//guest
Route::name('guest.')->group(function () {
    //view article
    Route::get('/articles/{slug}', [GuestArticleController::class, 'show'])->name('articles.show');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('check_admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('categories', Admin\CategoryController::class)
            ->except(['show', 'create']);

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users/{id}', [UserController::class, 'changeStatus'])->name('users.change-status');

        Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
        Route::get('/articles/{id}', [AdminArticleController::class, 'show'])->name('articles.show');
        Route::get('/articles/{id}/{status}', [AdminArticleController::class, 'changeStatus'])
            ->name('articles.change-status');
    });
