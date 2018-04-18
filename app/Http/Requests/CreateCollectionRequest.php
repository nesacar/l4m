<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCollectionRequest extends FormRequest
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
            'order' => 'required|integer',
            'brand_id' => 'required|numeric|min:1',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Naziv brenda je obavezan',
            'order.required' => 'Redosled je obavezan',
            'order.integer' => 'Redosled mora biti broj',
            'brand_id.required' => 'Brend je obavezan',
            'brand_id.numeric' => 'Brend je obavezan',
            'brand_id.min' => 'Brend je obavezan',
        ];
    }
}
