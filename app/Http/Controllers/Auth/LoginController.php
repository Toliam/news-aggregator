<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTO\LoginUserDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LoginService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class LoginController extends Controller
{
    public function __construct(private readonly LoginService $service) {}

    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $user = $this->service->attempt(LoginUserDTO::from($request->validated()));

            // «логин» пользователя в текущей сеcсии Sanctum
            Auth::login($user);

            // Sanctum: возвращаем токен-cookie + XSRF-cookie
            return response()->json([
                'message' => 'Logged in',
                'user'    => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
            ]);
        } catch (AuthenticationException) {
            return response()->json(['message' => 'Email or password incorrect.'], 401);
        }
    }
}
