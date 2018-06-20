<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
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
            'phone' => 'required',
            'address' => 'required',
            'town' => 'required',
            'country' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime i prezime je obavezno',
            'phone.required' => 'Telefon je obavezan',
            'address.required' => 'Adresa je obavezna',
            'town.required' => 'Grad je obavezan',
            'country.required' => 'Država je obavezna',
        ];
    }
}
