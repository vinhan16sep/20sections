<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class ProductRequest extends FormRequest {

    private $action;

    function __construct(Route $route, array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->action = $route;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'name' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'branding_id' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required',
            'description' => 'required',
            'content' => 'required',
            'production' => 'required'
        ];
        $action = $this->action->getActionMethod();
        if($action == 'update'){
            unset($rules['image']);
        }
        return $rules;
    }

    /**
     * @return array
     */
    public function messages() {
        $messages = [
            'name.required' => 'Tiêu đề không được trống',
            'image.required' => 'Vui lòng upload hình ảnh cho sản phẩm',
            'category_id.required' => 'Danh mục không được trống',
            'branding_id.required' => 'Thương hiệu không được trống',
            'quantity.required' => 'Số lượng không được trống',
            'price.required' => 'Giá không được trống',
            'description.required' => 'Giới thiệu không được trống',
            'content.required' => 'Nội dung không được trống',
            'production.required' => 'Nhà sản xuất không được trống',
            'quantity.numeric' => 'Số lượng phải là số'
        ];

        $action = $this->action->getActionMethod();
        if($action == 'update'){
            unset($messages['image.required']);
        }


        return $messages;
    }
}
