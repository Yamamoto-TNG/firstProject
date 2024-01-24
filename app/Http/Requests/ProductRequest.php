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
            'product_name' => 'required | max:255',
            'company_id' => 'required | max:255',
            'price' => 'required | max:255 | integer',
            'stock' => 'required | max:255 | integer',
            'comment' => 'max:10000',
            'img_path' => 'image',
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
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'company_id.required' => ':attributeは必須項目です。',
            'company_id.max' => ':attributeは:max字以内で入力してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.integer' => ':attributeは半角数字で入力してください。',
            'price.max' => ':attributeは:max字以内で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.integer' => ':attributeは半角数字で入力してください。',
            'stock.max' => ':attributeは:max字以内で入力してください。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
            'img_path.image' => ':attributeは画像ファイルを選択してください。',
        ];
    }
}
