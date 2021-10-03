<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentStoreRequest extends FormRequest
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
            'title' => 'required|max:150',
            'file'  => 'required|mimes:pdf|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => 'Only pdf files are allowed',
            'file.max'   => 'File should not greater than 5mb',
        ];
    }
}
