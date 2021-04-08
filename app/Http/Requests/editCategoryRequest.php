<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editCategoryRequest extends FormRequest
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
            'name'=>'required',
            'mota'=>'required',
            'status'=>'required|numeric|in:0,1',
        ];
    }
    public function messages()
    { 
        return[
           'name.required'=>'Tên danh mục không được bỏ trống',
           'mota.required'=>'Mô tả không được bỏ trống',
           'status.required'=>'trạng thái không hợp lệ',
           'status.numeric'=>'trạng thái không hợp lệ',
           
       ];
   }
}
