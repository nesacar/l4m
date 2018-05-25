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
            'cat_ids' => 'required|array|min:1',
            'brand_id' => 'required|numeric|min:1',
            'att_ids' => 'required|array|min:1',
            'price' => 'required|numeric|min:1',
            'publish_at' => 'required|date',
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
            'cat_ids.required' => 'Kategorija je obavezna',
            'cat_ids.array' => 'Kategorija je obavezna',
            'cat_ids.min' => 'Kategorija je obavezna',
            'brand_id.required' => 'Brend je obavezan',
            'brand_id.numeric' => 'Brend je obavezan',
            'brand_id.min' => 'Brend je obavezan',
            'att_ids.required' => 'Jedan atribut je obavezan',
            'att_ids.numeric' => 'Jedan atribut je obavezan',
            'att_ids.min' => 'Jedan atribut je obavezan',
            'price.required' => 'Cena je obavezna',
            'price.numeric' => 'Cena je obavezna',
            'price.min' => 'Cena je obavezna',
            'publish_at.required' => 'Datum publikovanja je obavezan',
            'publish_at.date' => 'Datum publikovanja  nije u ispravnom formatu',
        ];
    }
}
