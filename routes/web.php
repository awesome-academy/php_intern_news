<?php

use App\Http\Controllers\ArticleController as GuestArticleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('articles', User\ArticleController::class);
    });

//guest
Route::name('guest.')->group(function () {
    //view article
    Route::get('/articles/{slug}', [GuestArticleController::class, 'show'])->name('articles.show');
});
