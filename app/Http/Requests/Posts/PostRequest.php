<?php

declare(strict_types=1);

namespace App\Http\Requests\Posts;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<string,int|string>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|bail|string|max:255',
            'body' => 'required|bail|string|max:4096',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
            'cover' => 'nullable|url:http,https',
        ];
    }
}
