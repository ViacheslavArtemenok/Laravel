<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountController;
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

Route::resource('account', AccountController::class);

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::get('/', AdminController::class)
            ->name('index');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('authors', AdminAuthorController::class);
        Route::resource('users', AdminUserController::class);
    });
});

Route::get('/', IndexController::class)
    ->name('info.index');
//news routes
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
Route::get('/categories/{id}/news', [NewsController::class, 'index'])
    ->where('id', '\d+')
    ->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');

Auth::routes();

//Route::get('/account', [App\Http\Controllers\HomeController::class, 'index'])->name('account');
