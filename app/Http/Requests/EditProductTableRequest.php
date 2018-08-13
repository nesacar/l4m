<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductTableRequest extends FormRequest
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
            'sifra_artikla.value' => 'required|max:255',
            'naziv.value' => 'required|max:255',
            'dan_objave.value' => 'required|max:255',
            'vreme_objave.value' => 'required|max:255',
            'kolicina.value' => 'required|numeric',
            'cena.value' => 'required|numeric',
            'kratak_opis.value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sifra_artikla.value.required' => 'Šifra artikla je obavezna ',
            'naziv.value.required' => 'Naziv artikla je obavezan ',
            'dan_objave.value.required' => 'Dan objave je obavezan ',
            'vreme_objave.value.required' => 'Vreme objave je obavezno ',
            'kolicina.value.required' => 'Količina je obavezna ',
            'cena.value.required' => 'Cena je obavezna ',
            'kratak_opis.value.required' => 'Kratak opis je obavezan ',
        ];
    }
}
