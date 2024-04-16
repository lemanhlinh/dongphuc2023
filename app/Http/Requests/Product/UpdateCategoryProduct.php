<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryProduct extends FormRequest
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
            'alias' => 'nullable',
            'image' => 'nullable',
            'ordering' => 'nullable',
            'active' => 'required|numeric|integer|min:0',
            'is_home' => 'required|numeric|integer|min:0',
            'content' => 'nullable',
            'content_top' => 'nullable',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ];
    }
}
