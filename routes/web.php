<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleproController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterProController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\PublishArticleController;

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


Auth::routes(['verify' => true]);


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
    Route::get('/professional', [RegisterProController::class, 'index'])->name('professional');
    Route::get('/professional-create-article', [ArticleproController::class, 'create'])->name('articlepro.create');
    Route::post('/professional-create-article',[ArticleproController::class, 'store'])->name('articlepro.store');
    Route::get('/professional/{professional}/edit', [RegisterProController::class, 'edit'])->name('professional.edit');
    Route::post('/professional/{professional}', [RegisterProController::class, 'update'])->name('professional.update');
});

//USERS ROUTES
// Route::middleware(['auth', 'user'])->group(function(){

    Route::resource('categories', CategoryController::class);
    Route::resource('demandes', DemandeController::class);

// });

Route::get('/professional/create', [RegisterProController::class, 'create'])->name('professional.create');
Route::post('/professional', [RegisterProController::class, 'store'])->name('professional.store');

//USERS ROUTES
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');

//DISPLAY ARTICLES ROUTES
Route::get('/professional', [PublishArticleController::class, 'index']);
Route::get('article/{id}/show',  [PublishArticleController::class, 'show'])->name('show');

//LIKES
Route::post('/articles/likes', [PublishArticleController::class, 'liker'])->name('articles.like');

//COMMENTS
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/articles/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

