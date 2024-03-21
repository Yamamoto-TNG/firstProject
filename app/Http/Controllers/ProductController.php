<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
// use Kyslik\ColumnSortable\Sortable;

class ProductController extends Controller
{
    // 一覧
    public function showList() {
        $companies = Company::all();
        $products = Product::sortable()->get();

        return view('home', compact('products'), compact('companies'));
    }

    // 非同期
    public function getProductsBySearch(Request $request) {

        // Productモデルに基づいてクエリビルダを初期化
        $query = Product::query();

        // この行の後にクエリを逐次構築していきます。
        // そして、最終的にそのクエリを実行するためのメソッド（例：get(), first(), paginate() など）を呼び出すことで、データベースに対してクエリを実行します。

        // 商品名の検索キーワードがある場合、そのキーワードを含む商品をクエリに追加
        if($searchKeyword = $request->keyword){
            $query->where('product_name', 'LIKE', "%{$searchKeyword}%");
        }

        if($searchCompanyId = $request->company_id){
            $query->where('company_id', $searchCompanyId);
        }

        $products = $query->get();

        return response()->json($products);
    }

    // 上記の条件(クエリ）に基づいて商品を取得し、10件ごとのページネーションを適用
        // $products = $query->paginate(3);


    // 新規登録画面
    public function showRegistForm() {
        $companies = Company::all();

        return view('regist', compact('companies'));
    }

    public function submitRegistform(ProductRequest $request) {
        //①画像ファイルの取得
        $img = $request->file('img_path');

        if ($img) {
            //②画像ファイルのファイル名を取得
            $file_name = $img->getClientOriginalName();

            //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
            $img->storeAs('public/images', $file_name);

            //④データベース登録用に、ファイルパスを作成
            $img_path = 'storage/images/' . $file_name;
        } else {
            $img_path = null;
        }

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Product();
            //⑤モデルのregistArticle関数を呼び出し。
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
        //①画像ファイルの取得
        $img = $request->file('img_path');

        if ($img) {
            //②画像ファイルのファイル名を取得
            $file_name = $img->getClientOriginalName();

            //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
            $img->storeAs('public/images', $file_name);

            //④データベース登録用に、ファイルパスを作成
            $img_path = 'storage/images/' . $file_name;
        } else {
            $img_path = null;
        }

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
        return redirect(route('home'));
    }

    // 詳細画面
    public function showDetail($id)
    {
        $product = Product::find($id);

        return view('detail', compact('product'));
    }


}