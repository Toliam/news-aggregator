<?php

namespace App\Services;

use App\Http\DTO\CreateUserDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

readonly class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function store(CreateUserDTO $DTO): User
    {
        return $this->userRepository->store($DTO);
    }
}
