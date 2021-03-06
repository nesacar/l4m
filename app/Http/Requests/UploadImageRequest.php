<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'file' => 'image',
            'image' => 'image',
            'slider' => 'image',
            'cover' => 'image',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'file.image' => 'Slika nije u ispravnom formatu',
            'image.image' => 'Slika nije u ispravnom formatu',
            'slider.image' => 'Slika nije u ispravnom formatu',
            'cover.image' => 'Slika nije u ispravnom formatu',
        ];
    }
}
