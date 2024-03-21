<?php

use Illuminate\Support\Facades\Route;
// "Route"というツールを使うために必要な部品を取り込んでいます。
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
// ProductControllerに繋げるために取り込んでいます
use Illuminate\Support\Facades\Auth;
// "Auth"という部品を使うために取り込んでいます。この部品はユーザー認証（ログイン）に関する処理を行います

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
    // ウェブサイトのホームページ（'/'のURL）にアクセスした場合のルートです
    return redirect()->route('home');
});

Auth::routes();
// Auth::routes();はLaravelが提供している便利な機能で
// 一般的な認証に関するルーティングを自動的に定義してくれます
// この一行を書くだけで、ログインやログアウト
// パスワードのリセット、新規ユーザー登録などのための
// ルートが作成されます。
//　つまりログイン画面に用意されたビューのリンク先がこの1行で済みます

// 商品情報一覧画面
Route::get('/home', [App\Http\Controllers\ProductController::class, 'showList'])->name('home')->middleware('auth');
Route::post('/delete/{id}', [App\Http\Controllers\ProductController::class, 'submitDeleteButton'])->name('delete');
// 非同期処理
Route::get('/search', [App\Http\Controllers\ProductController::class, 'getProductsBySearch'])->name('search');
Route::get('getCompanyName/{company_id}', [App\Http\Controllers\CompanyController::class, 'getCompanyName']);


// 商品情報登録画面
Route::get('/regist',[App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('regist')->middleware('auth');
Route::post('/regist',[App\Http\Controllers\ProductController::class, 'submitRegistForm'])->name('submit');

// 商品情報詳細画面
Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('detail')->middleware('auth');

// 商品情報編集画面
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'showEditForm'])->name('edit')->middleware('auth');
Route::post('/edit/{id}', [App\Http\Controllers\ProductController::class, 'submitEditForm'])->name('update');

