<?php

namespace App\Repositories;

use App\Enums\UserStatus;
use App\Http\DTO\CreateUserDTO;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function store(CreateUserDTO $DTO): User
    {
        return User::query()->create(array_merge(
            $DTO->toArray(),
            ['status' => UserStatus::PENDING],
        ));
    }
}
