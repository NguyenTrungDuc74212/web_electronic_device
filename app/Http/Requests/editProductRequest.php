<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editProductRequest extends FormRequest
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
            'image' =>'mimes:pdf,xlx,csv,jpg|max:2048',
            'name'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'description'=>'required',
            'content'=>'required',
            'price'=>'required',
            'status'=>'required|numeric|in:0,1',
        ];
    }
    public function messages()
    { 
        return[
           'name.required'=>'Tên danh mục không được bỏ trống',
           'quantity.required'=>'Số lượng sản phẩm không được bỏ trống',
           'description.required'=>'Mô tả không được bỏ trống',
           'content.required'=>'nội dung không được bỏ trống',
           'price.required'=>'Giá sản phẩm không được bỏ trống',
           'status.required'=>'trạng thái không hợp lệ',
           'status.numeric'=>'trạng thái không hợp lệ',
           
       ];
   }
}
