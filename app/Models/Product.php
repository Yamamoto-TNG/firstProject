<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Product extends Model
{
    use HasFactory;

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    // 商品に関連する会社（メーカー）を表す関連を定義
    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function registProduct($data, $img_path) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $img_path,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
    public function editProduct($data, $img_path){
        // 更新処理
        if ($img_path) {
            DB::table('products')->where('id', $data->id)->update([
                'product_name' => $data->product_name,
                'company_id' => $data->company_id,
                'price' => $data->price,
                'stock' => $data->stock,
                'comment' => $data->comment,
                'img_path' => $img_path,
                'updated_at' => new DateTime(),
            ]);
        } else {
            DB::table('products')->where('id', $data->id)->update([
                'product_name' => $data->product_name,
                'company_id' => $data->company_id,
                'price' => $data->price,
                'stock' => $data->stock,
                'comment' => $data->comment,
                'updated_at' => new DateTime(),
            ]);
        }
        
    }
    public function deleteProduct($id){
        // 削除処理
        DB::table('products')->where('id', $id)->delete();
    }

    public function scopeSearch($query, $request)
    {
        // 商品名の検索キーワードがある場合、そのキーワードを含む商品をクエリに追加
        if($searchKeyword = $request->keyword){
            $query->where('product_name', 'LIKE', "%{$searchKeyword}%");
        }

        if($searchCompanyId = $request->company_id){
            $query->where('company_id', $searchCompanyId);
        }

        // 最小価格が指定されている場合、その価格以下の商品をクエリに追加
        if($searchLowerPrice = $request->lower_price){
            $query->where('price', '>=', $searchLowerPrice);
        }
        // 最大価格が指定されている場合、その価格以上の商品をクエリに追加
        if($searchUpperPrice = $request->upper_price){
            $query->where('price', '<=', $searchUpperPrice);
        }
        // 最小在庫数が指定されている場合、その在庫数以下の商品をクエリに追加
        if($searchLowerStock = $request->lower_stock){
            $query->where('stock', '>=', $searchLowerStock);
        }
        // 最大在庫数が指定されている場合、その在庫数以上の商品をクエリに追加
        if($searchUpperStock = $request->upper_stock){
            $query->where('stock', '<=', $searchUpperStock);
        }

        return $query;
    }
}
