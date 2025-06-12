<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\TelegramBotService;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Contracts\Foundation\Application;
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
        $this->app->singleton(TelegramBotService::class, function (Application $app) {
            $cfg = config('telegram');
            return new TelegramBotService($cfg['bot_token'], $cfg['chat_id'], $cfg['api_url'], $cfg['timeout']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
