<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSubscriberRequest extends FormRequest
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
            'email' => 'required|email|unique:subscribers,email,'.$this->segment(3),
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email adresa je obavezna',
            'email.email' => 'Email adresa nije u ispravnom formatu',
            'email.unique' => 'Vaša email adresa već postoji u sistemu',
        ];
    }
}
