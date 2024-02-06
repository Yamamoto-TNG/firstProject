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

    public function submitRegistform(ProductRequest $request) {
        $img_path = productImagPath::getImgPath($request->file('img_path'), $request->id);

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->registProduct($request, $img_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらhomeにリダイレクト
        return redirect(route('home'));
    }

    // 編集登録画面
    public function showEditForm($id) {
        $product = Product::find($id);
        $companies = Company::all();

        return view('edit', compact('product'), compact('companies'));
    }

    public function submitEditForm(ProductRequest $request, $id) {
        $img_path = ProductImgPath::getImgPath($request->file('img_path'), $request->id);

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->editProduct($request, $img_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらhomeにリダイレクト
        return redirect()->route('detail', compact('id'));
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
        return redirect()->route('home');
    }
}


