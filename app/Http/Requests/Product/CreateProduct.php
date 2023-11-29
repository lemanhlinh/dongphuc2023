<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
            'sku' => 'nullable',
            'category_id' => 'required',
            'content' => 'nullable',
            'content_info' => 'nullable',
            'active' => 'required',
            'is_home' => 'nullable',
            'price' => 'nullable',
            'ordering' => 'nullable',
            'image' => 'nullable',
            'image_after' => 'nullable',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ];
    }
}
