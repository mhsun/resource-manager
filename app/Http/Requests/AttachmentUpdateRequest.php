<?php

namespace App\Http\Requests;

use App\Models\Attachment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class AttachmentUpdateRequest extends FormRequest
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
            'file'  => 'sometimes|mimes:pdf|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => 'Only pdf files are allowed',
            'file.max'   => 'File should not greater than 5mb',
        ];
    }

    public function uploadIfFileExistAgainst(Attachment $attachment)
    {
        $attachment->title = $this->get('title');

        if ($this->hasFile('file')) {
            $path = $this->file('file')->store("attachments");
            Storage::delete(storage_path("app/{$attachment->path}"));
            $attachment->path = $path;
        }

        $attachment->save();
    }
}
