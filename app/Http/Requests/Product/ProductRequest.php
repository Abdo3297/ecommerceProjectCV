<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required','string'],
            'price' => ['required','numeric','min:1'],
            'category_id' => ['required','integer',Rule::exists('categories','id')],
            'image' => ['required','image','mimes:png,jpg,jpeg,webp,svg','max:90000'],
        ];
    }
}
