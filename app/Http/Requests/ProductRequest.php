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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'branding_id' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required',
            'description' => 'required',
            'content' => 'required',
            'production' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được trống',
            'category_id.required' => 'Danh mục không được trống',
            'branding_id.required' => 'Thương hiệu không được trống',
            'quantity.required' => 'Số lượng không được trống',
            'price.required' => 'Giá không được trống',
            'description.required' => 'Giới thiệu không được trống',
            'content.required' => 'Nội dung không được trống',
            'production.required' => 'Nhà sản xuất không được trống',
            'quantity.numeric' => 'Số lượng phải là số'
        ];
    }
}
