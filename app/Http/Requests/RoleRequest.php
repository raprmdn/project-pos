<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role_name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($this->id)],
            'guard_name' => ['required', 'in:web,api'],
            'permissions' => ['required', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
