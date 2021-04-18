<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function(){
  return view('welcome');
});

Auth::routes(['verify' => true]);

Route::resource('home', HomeController::class);

Route::middleware('admin')->group(function() {
  Route::resource('users', UserController::class);
  // Route `url` can be defined freely, but will be led by controller for view
  Route::get('posts/categories', [CategoryController::class, 'index'])->name('category');
  Route::post('posts/categories', [CategoryController::class, 'store'])->name('create.category');
  Route::delete('posts/categories/{id}', [CategoryController::class, 'destroy'])->name('delete.category');
});

Route::middleware('auth')->group(function() {
  Route::post('posts/search', [PostController::class, 'search']);
  Route::post('posts/create', [PostController::class, 'store']);
  Route::put('posts/{id}', [PostController::class, 'update']);
  Route::delete('posts/{id}', [PostController::class, 'destroy']);
});

// Give some basic routes for these controllers
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);


// Public routes
Route::post('posts/searchcat', [PostController::class, 'searchcat']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
