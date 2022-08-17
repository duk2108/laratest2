<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

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


Route::get('/user', [UserController::class, 'showForm'])->name('user.form');
Route::post('/user', [UserController::class, 'showUser'])->name('user.added');
Route::get('/user/showexp', [UserController::class, 'showExp'])->name('user.showexp');
Route::get('/user/changeexp', [UserController::class, 'changeExp'])->name('user.changeexp');

Route::get('/user/avatar/{id}', [UserController::class, 'showAvatar'])->name('user.avatar');
Route::get('/user/authortest/{id}', [UserController::class, 'authorTest']);

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete');
