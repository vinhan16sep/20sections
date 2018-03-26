<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandingRequest extends FormRequest
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
            'category_id' => 'required'
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
        ];
    }
}
