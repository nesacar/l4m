<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title' => 'required',
            'code' => 'required',
            'category_id' => 'required|array|min:1',
            'brand_id' => 'required|numeric|min:1',
            'set_id' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
        ];
    }

    /**
     * Translations
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Naziv je obavezan',
            'code.required' => 'Šifra je obavezna',
            'category_id.required' => 'Kategorija je obavezna',
            'category_id.array' => 'Kategorija je obavezna',
            'category_id.min' => 'Kategorija je obavezna',
            'brand_id.required' => 'Brend je obavezan',
            'brand_id.numeric' => 'Brend je obavezan',
            'brand_id.min' => 'Brend je obavezan',
            'set_id.required' => 'Set je obavezan',
            'set_id.numeric' => 'Set je obavezan',
            'set_id.min' => 'Set je obavezan',
            'price.required' => 'Cena je obavezna',
            'price.numeric' => 'Cena je obavezna',
            'price.min' => 'Cena je obavezna',
        ];
    }
}
