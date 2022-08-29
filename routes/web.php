<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleproController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterproController;
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
        Route::resource('articles', ArticleController::class)->except(['delete']);
        Route::put('articles/{id}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
        Route::get('articles/{id}/view', [ArticleController::class, 'view'])->name('articles.view');
        Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
        Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');
    });

    //USERS ROUTES
    Route::resource('users', UserController::class)->except(['edit', 'update']);
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
    Route::get('users/{id}/view', [UserController::class, 'view'])->name('users.view');
});

//PROFESSIONAL ROUTE
Route::middleware(['auth', 'professional'])->group(function(){
    Route::get('/professional', [ProfessionalController::class, 'index'])->name('professional');
    Route::get('/professional-create-article', [ArticleproController::class, 'create'])->name('articlepro.create');
    Route::post('/professional-create-article',[ArticleproController::class, 'store'])->name('articlepro.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
});

Route::get('/professional/create', [RegisterproController::class, 'create'])->name('professional.create');
Route::post('/professional', [RegisterproController::class, 'store'])->name('professional.store');


Route::get('/home', [HomeController::class, 'index'])->name('home');

