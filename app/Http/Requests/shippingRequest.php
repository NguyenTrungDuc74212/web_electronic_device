<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shippingRequest extends FormRequest
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
            "email"=>"required|Email",
            "name"=>"required",
            "phone"=>"required|numeric",
            "address"=>"required",
            "payment_option"=>"required",
            "notes"=>"required",
        ];
    }
    public function messages()
    {
        return [
            "email.required"=>"email không được để trống",
            "notes.required"=>"ghi chú không được bỏ trống",
            "email.Email"=>"email không hợp lệ",
            "name.required"=>"tên không được để trống",
            "phone.required"=>"số điện thoại không được để trống",
            "phone.numeric"=>"số điện thoại phải là số",
            "address.required"=>"địa chỉ không được để trống",
            "payment_option.required"=>"hình thức thanh toán không được bỏ trống",
        ];
    }
}
