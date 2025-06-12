<?php

namespace App\Repositories;

use App\Http\DTO\CreateUserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function store(CreateUserDTO $DTO): User;
}
