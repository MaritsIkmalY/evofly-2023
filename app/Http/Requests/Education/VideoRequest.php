<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->role_id == 1;
    }

    public function rules(): array
    {
        return [
            'image' => 'mimes:pdf,png,jpg,jpeg',
            'title' => 'required',
            'url' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul video harus diisi',
            'description.required' => 'Deskripsi video harus diisi',
            'url.required' => 'URL video harus diisi'
        ];
    }
}
