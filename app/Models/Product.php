<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Product extends Model
{

    use HasFactory;

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
}
