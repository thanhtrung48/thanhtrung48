<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'detail' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price_buy' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'detail.required' => 'Chưa nhập từ khoá tìm kiếm',
            'metakey.required' => 'Chưa nhập từ khoá tìm kiếm',
            'metadesc.required' => 'Chưa nhập mô tả',
            'category_id.required' => 'Chưa nhập danh mục',
            'brand_id.required' => 'Chưa nhập thương hiệu',
            'price_buy.required' => 'Chưa nhập giá'
        ];
    }
}
