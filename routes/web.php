<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;

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
//HOME PAGE
Route::get('/', function () {
    return view('welcome');
});

//ADMIN ROUTE
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//ARTICLES ROUTES
Route::prefix('admin')->group(function () {
    Route::resource('articles', ArticleController::class);
});