<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UserRepositoryInterface::class => UserRepository::class,
        UserServiceInterface::class => UserService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
