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
            'name' => [
                'bail', 'required', 'string', 'max:255'
            ],
            'username' => [
                'bail', 'required', 'string', 'max:255',
                Rule::unique('users', 'username')->ignore($this->user()->id)
            ],
            'email' => [
                'bail', 'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'username')->ignore($this->user()->id)
            ],
            'password' => ['bail', 'nullable', 'string', 'min:6', 'max:255', 'confirmed']
        ];
    }
}
