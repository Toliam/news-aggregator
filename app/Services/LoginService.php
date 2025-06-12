<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\UserStatus;
use App\Http\DTO\LoginUserDTO;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

final class LoginService
{
    /**
     * @throws AuthenticationException
     */
    public function attempt(LoginUserDTO $DTO): User
    {
        /** @var User|null $user */
        $user = User::where('email', $DTO->email)->first();

        if (
            ! $user
            || $user->status !== UserStatus::ACTIVE
            || ! Hash::check($DTO->password, $user->password)
        ) {
            throw new AuthenticationException('Invalid credentials.');
        }

        // обновим last_login_at для аналитики
        $user->forceFill(['last_login_at' => now()])->save();

        return $user;
    }
}
