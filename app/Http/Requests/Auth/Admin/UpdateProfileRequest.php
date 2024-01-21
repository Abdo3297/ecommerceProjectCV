<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>['required','string','min:3','max:50'],
            'birth' => ['required','date','date_format:d-m-Y'],
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
