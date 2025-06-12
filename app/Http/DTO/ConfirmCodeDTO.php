<?php
declare(strict_types=1);

namespace App\Http\DTO;

readonly class ConfirmCodeDTO
{
    public function __construct(public int $userId, public string $code) {
    }

    public static function from(array $attributes): ConfirmCodeDTO
    {
        return new self(
            (int) $attributes['user_id'],
            $attributes['code']
        );
    }
}
