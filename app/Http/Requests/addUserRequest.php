<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addUserRequest extends FormRequest
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
           'email'=>'required|unique:tbl_admin,email',
           'phone'=>'required|numeric',
           'password'=>'required|min:8',
           're-password'=>'required|same:password',
        ];
    }
    public function messages()
    {
        return [
             'name.required'=>'Bạn phải nhập tên',
             'email.required'=>'Bạn phải nhập email',
             'phone.required'=>'Bạn phải nhập số điện thoại',
             'email.unique'=>'email đã tồn tại',
             'password.required'=>'Bạn phải nhập pass',
             're-password.required'=>'Bạn phải nhập lại pass',
             'password.min'=>'pass không hợp lệ',
        ];
    }
}
