<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WebinarRequest extends FormRequest
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
            'type' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul webinar harus diisi',
            'description.required' => 'Deskripsi webinar harus diisi',
            'type.required' => 'Tipe webinar harus diisi'
        ];
    }
}
