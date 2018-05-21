<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCurrencyRequest extends FormRequest
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
            'code' => 'required',
            'exchange_rate' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naziv je obavezan',
            'code.required' => 'Kod je obavezan',
            'exchange_rate.required' => 'Vrednost je obavezna',
            'exchange_rate.numeric' => 'Vrednost mora biti broj',
            'exchange_rate.min' => 'Vrednost mora biti pozitivan broj',
        ];
    }
}
