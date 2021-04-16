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

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('home', HomeController::class);

Route::middleware('admin')->group(function() {
  Route::resource('users', UserController::class);
  Route::get('posts/category', [CategoryController::class, 'index'])->name('category');
  Route::post('posts/category/create', [CategoryController::class, 'store'])->name('create.category');
  Route::delete('posts/category/delete/{id}', [CategoryController::class, 'destroy'])->name('delete.category');
});

Route::middleware('auth')->group(function() {
  Route::post('posts/create', [PostController::class, 'store']);
  Route::put('posts/{id}', [PostController::class, 'update']);
  Route::delete('posts/{id}', [PostController::class, 'destroy']);
});

Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);


// Public routes
Route::post('posts', [PostController::class, 'search']);
Route::post('posts/searchcat', [PostController::class, 'searchcat']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
