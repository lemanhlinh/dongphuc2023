<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class CreateBanner extends FormRequest
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
            'active' => 'required',
            'type' => 'required',
            'link' => 'nullable',
            'content' => 'nullable',
            'ordering' => 'nullable',
            'image' => 'nullable',
        ];
    }
}
