<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->hasUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'id')],
            'email' => 'required|nullable|string|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:6|confirmed'
        ];
    }
}
