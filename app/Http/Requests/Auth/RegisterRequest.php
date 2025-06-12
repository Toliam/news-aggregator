<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:191'],
            'email'    => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'password' => [
                'required',
                Password::min(12)->letters()->numbers()->mixedCase()->symbols(),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
