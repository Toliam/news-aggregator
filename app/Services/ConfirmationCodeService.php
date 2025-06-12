<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ConfirmationCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

final readonly class ConfirmationCodeService
{
    public function __construct(
        private int $confirmCodeTTL,
        private int $confirmCodeLength,
    ) {
    }

    /** Создаёт уникальный код и сохраняет его в БД */
    public function create(int $userId): ConfirmationCode
    {
        // todo: make repository
        do {
            $code = Str::padLeft((string) random_int(0, 10**$this->confirmCodeLength - 1), $this->confirmCodeLength, '0');
        } while (
            ConfirmationCode::query()
                ->where('user_id', $userId)
                ->where('code', $code)
                ->exists()
        );

        // Сохраняем новый код
        return ConfirmationCode::query()->create([
            'user_id'    => $userId,
            'code'       => $code,
            'expires_at' => Carbon::now()->addMinutes($this->confirmCodeTTL),
        ]);
    }
}
