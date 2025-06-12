<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class LogoutController extends Controller
{
    public function __invoke(): JsonResponse
    {
        /** @var \Laravel\Sanctum\HasApiTokens $user */
        $user = Auth::user();

        // отзываем только текущий токен cookie
        $user?->currentAccessToken()?->delete();

        Auth::guard('web')->logout();

        return response()->json(['message' => 'Logged out']);
    }
}
