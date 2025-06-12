<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Services\ConfirmationCodeService;
use App\Services\TelegramBotService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

final class SendConfirmationCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public int $tries = 5;
    public array $backoff = [15, 30, 60]; // секунды

    public function __construct(
        public readonly int $userId,
    ) {
        $this->onConnection('rabbitmq');
        $this->onQueue('confirm.codes');
    }

    public function handle(
        ConfirmationCodeService $codeService,
        TelegramBotService $bot,
    ): void {
        $code = $codeService->create($this->userId)->code;

        $bot->sendMessage(
            sprintf('🛡️ Код подтверждения: <b>%s</b>', $code),
            ['disable_notification' => true]
        );
    }
}
