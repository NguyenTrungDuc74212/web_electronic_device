<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
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
            "email"=>"required",
            "password"=>"required",
            "re_password"=>"required|same:password"
        ];
    }
    public function messages()
    { 
        return[
           "email.required" =>"bạn phải nhập email",
           "password.required" =>"bạn phải nhập mật khẩu muốn reset",
           "re_password.required" =>"bạn phải nhập lại mật khẩu muốn reset",
           "re_password.same" =>"Mật khẩu không khớp"
           
       ];
   }

}
