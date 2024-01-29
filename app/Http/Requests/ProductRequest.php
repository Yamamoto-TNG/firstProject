<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required | integer',
            'stock' => 'required | integer',
            'img_path' => 'nullable | image',
        ];
    }
    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'company_id.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'price.integer' => ':attributeは半角数字で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.integer' => ':attributeは半角数字で入力してください。',
            'img_path.image' => ':attributeは画像ファイルを選択してください。',
        ];
    }
}
