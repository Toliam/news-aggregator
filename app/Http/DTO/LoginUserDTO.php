<?php

namespace App\Http\DTO;

final readonly class LoginUserDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    public static function from(array $attributes): LoginUserDTO
    {
        return new self($attributes['email'], $attributes['password']);
    }
}
