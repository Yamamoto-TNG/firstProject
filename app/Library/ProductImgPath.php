<?php

namespace App\Library;

class ProductImgPath
{
    public static function getImgPath($img, $id) {
        $file_name = 'product_img_' . sprintf('%03d',$id) . '.' . $img->getClientOriginalExtension();
        $img->storeAs('public/images', $file_name);
        $img_path = 'storage/images/' . $file_name;

        return $img_path;
    }
}