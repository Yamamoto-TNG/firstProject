<?php

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

Route::get('/home', [App\Http\Controllers\ProductController::class, 'showList'])->name('home');
Route::get('/regist',[App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('regist');
Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');