<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\captcha_rule;

class addCustomerRequest extends FormRequest
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
            "name"=>"required|unique:tbl_customer,name|max:12",
            "email"=>"required|unique:tbl_customer,email",
            "password"=>"required",
            "re_password"=>"required|same:password",
            "g-recaptcha-response" => new captcha_rule(),    
            "phone"=>"required",
            
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>"Bạn phải nhập tên",
            "email.required"=>"Bạn phải nhập email",
            "password.required"=>"Bạn phải nhập password",
            "re_password.required"=>"Bạn phải nhập password",
            "phone.required"=>"Bạn phải nhập số điện thoại",
            "re_password.same"=>"Mật khẩu không trùng khớp",
            "name.max"=>"Tên phải nhỏ hơn 12 ký tự",


        ];
    }
}
