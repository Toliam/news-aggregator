<?php

namespace App\Http\DTO;

use Illuminate\Support\Facades\Hash;

readonly class CreateUserDTO
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password,
    ) {
    }

    public static function from(array $validated): CreateUserDTO
    {
        return new self(
            $validated['name'],
            $validated['email'],
            Hash::make($validated['password']),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
