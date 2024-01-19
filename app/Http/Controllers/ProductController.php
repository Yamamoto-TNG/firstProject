<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showList() {
        // インスタンス生成
        $model = new Product();
        $products = $model->getList();

        return view('home', ['products' => $products]);
    }
}

