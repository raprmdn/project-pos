<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'permission_name' => ['required', 'max:255', Rule::unique('permissions', 'name')->ignore($this->id)],
            'guard_name' => ['required', 'string', 'in:web,api'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
