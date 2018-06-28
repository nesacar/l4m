<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBoxRequest extends FormRequest
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
            'order' => 'required|numeric|min:1',
            'block_id' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'order.required' => 'Redosled je obavezan',
            'order.numeric' => 'Redosled je obavezan',
            'order.min' => 'Redosled je obavezan',
            'block_id.required' => 'Šablon je obavezan',
            'block_id.numeric' => 'Šablon je obavezan',
            'block_id.min' => 'Šablon je obavezan',
        ];
    }
}
