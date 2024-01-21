<?php

namespace App\Http\Requests\Auth\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SignupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name'=>['required','string','min:3','max:50'],
            'email'=>['required','string','email','unique:' . User::class],
            'password' => ['required','confirmed', Rules\Password::defaults()],
            'birth' => ['required','date','date_format:d-m-Y'],
        ];
    }
}
