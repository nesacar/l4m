<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required',
            'address' => 'required',
            'town' => 'required',
            'postcode' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno',
            'lastname.required' => 'Prezime je obavezno',
            'email.required' => 'Email adresa je obavezna',
            'email.email' => 'Email adresa nije u ispravnom formatu',
            'email.unique' => 'Email adresa već postoji u našem sistemu',
            'password.required' => 'Lozinka je obavezna',
            'password.confirmed' => 'Niste dobro potvrdili lozinku',
            'password.min' => 'Lozinka mora imati minimum 6 karaktera',
            'phone.required' => 'Telefon je obavezan',
            'address.required' => 'Adresa je obavezna',
            'town.required' => 'Grad je obavezan',
            'postcode.required' => 'Poštanski broj je obavezan',
        ];
    }
}
