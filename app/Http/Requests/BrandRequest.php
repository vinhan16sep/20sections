<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được trống',
            'email.required' => 'Địa chỉ Email không được trống',
            'password.required' => 'Mật khẩu không được trống',
            'password_confirmation.required' => 'Xác nhận email không được trống',
            'email.email' => 'Định dạng Email không đúng',
            'password.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng',
        ];
    }
}
