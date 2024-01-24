<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList() {
        // articlesテーブルからデータを取得
        $products = DB::table('products')->get();
    
        return $products;
    }
    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->productName,
            'Company_id' => $data->CompanyId,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_pathnt' => $data->imgPath,
        ]);
    }
}
