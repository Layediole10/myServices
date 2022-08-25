<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfessionalController;

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
Route::get('/', function (){
    return view('welcome');
});

Route::get('/registration', function (){
    return view('sign');
})->name('signin');


Auth::routes();

//ADMIN ROUTE
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    //ARTICLES ROUTES
    Route::prefix('admin')->group(function () {
        Route::resource('articles', ArticleController::class)->except(['delete']);;
        Route::put('articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
        Route::get('articles/{id}/view', [ArticleController::class, 'view'])->name('articles.view');
        Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });
});

//PROFESSIONAL ROUTE
Route::middleware(['auth', 'professional'])->group(function(){
    Route::get('/professional', [ProfessionalController::class, 'index'])->name('professional');
});



Route::get('/home', [HomeController::class, 'index'])->name('home');

