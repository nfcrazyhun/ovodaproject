<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
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
            'student_id' => '',
            'street_name' => 'required',
            'street_number' => 'required',
            'zip' => 'required|integer|min:1000|max:9999',
            'city' => 'required',
            'siblings_num' => 'required|integer|max:127',
        ];
    }
}
