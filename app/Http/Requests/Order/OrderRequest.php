<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'user_id' => ['nullable',Rule::exists('users','id')],
            'product_id' => ['required',Rule::exists('products','id')],
            'qty' => ['required','integer','min:1'],
        ];
    }
}
