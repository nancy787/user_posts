<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::group(['middleware' => 'blocked'], function () {
    // Routes that should be protected by CheckBlocked middleware
});


Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::delete('/posts/{id}', [PostController::class,'destroy'])->name('posts.destroy');
});

Route::group(['middleware' => 'role:user'], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('role:admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::delete('/posts/{id}', [PostController::class,'destroy'])->name('posts.destroy');
