<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequestValidation extends FormRequest
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
            'ship_first_name' => 'required|min:3',
            'ship_last_name' => 'required|min:2',
            'ship_phone' => 'required|min:6',
            'ship_business_name' => 'required|min:3',
            'ship_address_line_1' => 'required|min:6',
            'ship_postal_code' => 'required',
            'ship_city' => 'required',
            'ship_state' => 'required',
            'ship_country' => 'required',
//            'shipping_method' => 'required',
        ];
    }
}
