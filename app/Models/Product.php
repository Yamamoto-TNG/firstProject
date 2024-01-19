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
}
