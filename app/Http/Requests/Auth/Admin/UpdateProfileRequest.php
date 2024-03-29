<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>['sometimes','string','min:3','max:50'],
            'birth' => ['sometimes','date','date_format:d-m-Y'],
            'image' => ['sometimes','image','mimes:png,jpg,jpeg,webp,svg','max:90000'],
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}
