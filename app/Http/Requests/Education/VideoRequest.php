<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->role_id == 1;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
