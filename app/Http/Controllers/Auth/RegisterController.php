<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\DTO\CreateUserDTO;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

final class RegisterController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService,
    ) {
    }

    public function handle(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->store(CreateUserDTO::from($request->validated()));

        return new JsonResponse([
            'message' => 'Registration successful. Complete verification to activate account.',
            'user_id' => $user->id,
        ], Response::HTTP_CREATED);
    }
}
