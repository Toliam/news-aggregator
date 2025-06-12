<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\ConfirmationCodeService;
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
            return new TelegramBotService(
                config('telegram.bot_token'),
                config('telegram.chat_id'),
                config('telegram.api_url'),
                config('telegram.timeout')
            );
        });

        $this->app->singleton(ConfirmationCodeService::class, function (Application $app) {
            return new ConfirmationCodeService(config('auth.confirm_code_ttl'), config('auth.confirm_code_length'));
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
