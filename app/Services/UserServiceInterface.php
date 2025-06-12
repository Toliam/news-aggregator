<?php

namespace App\Services;

use App\Http\DTO\CreateUserDTO;
use App\Models\User;

interface UserServiceInterface
{
    public function store(CreateUserDTO $DTO): User;
}
