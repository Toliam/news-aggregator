<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    protected $casts = [
        'password'      => 'hashed',
        'status'        => UserStatus::class,
        'last_login_at' => 'datetime',
    ];

    // relationship
    // public function confirmationCodes(): HasMany
    // {
    //     return $this->hasMany(ConfirmationCode::class);
    // }
}
