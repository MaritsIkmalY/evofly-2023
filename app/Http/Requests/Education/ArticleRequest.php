<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends FormRequest
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
            'body' => 'required',
            'author' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul artikel harus diisi',
            'body.required' => 'Isi artikel harus diisi',
            'author.required' => 'Penulis artikel harus diisi'
        ];
    }
}
