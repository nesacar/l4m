<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttributeRequest extends FormRequest
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
            'property_id' => 'required|numeric|min:1',
            'order' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Naziv je obavezan',
            'property_id.required' => 'Osobina je obavezna',
            'property_id.numeric' => 'Osobina je obavezna',
            'property_id.min' => 'Osobina je obavezna',
            'order.required' => 'Redosled je obavezan',
            'order.numeric' => 'Redosled je obavezan',
            'order.min' => 'Redosled je obavezan',
        ];
    }
}
