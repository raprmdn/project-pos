<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'unit' => ['required'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'price' => ['required', 'min:0'],
            'description' => ['nullable', 'string', 'max:255'],
            'product_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:3048'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
