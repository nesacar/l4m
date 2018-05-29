<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyRequest extends FormRequest
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
            'order' => 'required|numeric|min:1',
            'cat_ids' => 'required|array|min:1',
        ];
    }

    /**
     * Translation error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Naziv je obavezan',
            'order.required' => 'Redosled je obavezan',
            'order.numeric' => 'Redosled mora biti broj',
            'order.min' => 'Redosled je obavezan',
            'cat_ids.required' => 'Kategorija je obavezna',
            'cat_ids.array' => 'Kategorija je obavezna',
            'cat_ids.min' => 'Kategorija je obavezna',
        ];
    }
}
