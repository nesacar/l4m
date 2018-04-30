<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProductCodeRequest extends FormRequest
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
            'code' => 'required|unique:products,code,'.$this->segment(3),
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Šifra je obavezna',
            'code.unique' => 'Šifra već postoji',
        ];
    }
}
