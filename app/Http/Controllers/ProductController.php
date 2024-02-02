<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 一覧
    public function showList() {
        $products = Product::all();

        return view('home', compact('products'));
    }
    // 新規登録画面
    public function showRegistForm() {
        $companies = Company::all();
        return view('regist', compact('companies'));
    }
    // 編集画面
    public function showEdit($id) {
        $product = Product::find($id);
        $companies = Company::all();
        return view('edit', compact('product'), compact('companies'));
    }
    // 新規登録画面
    public function registSubmit(ProductRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらhomeにリダイレクト
        return redirect(route('home'));
    }

    // 編集登録画面
    public function update(ProductRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->updateProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらhomeにリダイレクト
        return redirect(route('home'));
    }
    // 削除処理
    public function submitDeleteButton($id) {

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->deleteProduct($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        // 処理が完了したらhomeにリダイレクト
        return redirect(route('home'));
    }

    // 詳細画面
    public function showDetail($id)
    {
        $product = Product::find($id);

        return view('detail', compact('product'));
    }
}


