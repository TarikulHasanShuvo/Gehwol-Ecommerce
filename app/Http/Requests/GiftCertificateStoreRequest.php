<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftCertificateStoreRequest extends FormRequest
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
            'recipient_name' => 'required|min:3|max:255',
            'client_name' => 'required|min:3|max:255',
            'recipient_email' => 'required|email|string',
            'client_email' => 'required|email|string',
            'amount' => 'required|numeric|min:10|max:250',
            'type' => 'required'
        ];
    }
}
