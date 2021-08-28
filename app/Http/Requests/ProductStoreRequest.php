<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required',
            'brand' => 'required',
            'product_category_id' => 'required',
            'product_bl_category_id' => 'required',
            'product_type_id' => 'required',
            'code' => 'required',
            'unit_value' => 'required',
            'unit_type' => 'required',
            'no_of_identical_products' => 'required',
            'original_price' => 'required',
        ];
    }
}
