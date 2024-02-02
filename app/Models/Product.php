<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
        ]);
    }
    public function updateProduct($data){
        // 更新処理
        DB::table('products')->where('id', $data->id)->update([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
        ]);
    }
    public function deleteProduct($id){
        // 削除処理
        DB::table('products')->where('id', $id)->delete();
    }
}
