<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\UserStatus;
use App\Http\DTO\ConfirmCodeDTO;
use App\Models\ConfirmationCode;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

final class CodeVerificationService
{
    /** @throws ModelNotFoundException */
    public function verify(ConfirmCodeDTO $DTO): void
    {
        // todo: make repository
        DB::transaction(function () use ($DTO): void {
            /** @var ConfirmationCode $record */
            $record = ConfirmationCode::query()
                ->where('user_id', $DTO->userId)
                ->where('code', $DTO->code)
                ->whereNull('used_at')
                ->where('expires_at', '>', CarbonImmutable::now())
                ->lockForUpdate() // защита от гонки
                ->firstOrFail();

            /** @var User $user */
            $user = $record->user()->lockForUpdate()->first();

            $record->update(['used_at' => now()]);
            $user->update(['status' => UserStatus::ACTIVE]);
        });
    }
}
