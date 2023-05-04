<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'metakey' => 'required',
            'metadesc' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.min' => 'Tên ít nhất 2 ký tự',
            'metakey.required' => 'Chưa nhập từ khoá tìm kiếm',
            'metadesc.required' => 'Chưa nhập mô tả'
        ];
    }
}
