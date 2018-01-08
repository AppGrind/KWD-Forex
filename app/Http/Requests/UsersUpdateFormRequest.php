<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateFormRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'contactnumber' => 'required|numeric',
            'address' => 'required',
            'town' => 'required',
            'province' => 'required',
            'postalcode' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'First Name is required.',
            'lastname.required' => 'Last Name is required.',
            'contactnumber.required' => 'Contact Number is required.',
            'address.required' => 'Address is required',
            'town.required' => 'Town is required',
            'province.required' => 'Province is required',
            'postalcode.required' => 'Post Code is required',
        ];
    }
}
