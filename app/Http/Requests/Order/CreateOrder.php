<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrder extends FormRequest
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
            'sender_name' => 'required',
            'sender_telephone' => [
                'required',
                'regex:/^(0|\+84)[0-9]{9,10}$/'
            ],
            'sender_address' => 'required',
            'payment_method' => 'required',
            'sender_comments' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'sender_name.required' => 'Vui lòng nhập Họ tên.',
            'sender_address.required' => 'Vui lòng nhập địa chỉ.',
            'sender_telephone.required' => 'Số điện thoại là bắt buộc.',
            'sender_telephone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại bắt đầu bằng số 0 và có 9-10 chữ số.'
        ];
    }
}
