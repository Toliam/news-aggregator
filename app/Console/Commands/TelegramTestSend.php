<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\TelegramBotService;
use Illuminate\Console\Command;

class TelegramTestSend extends Command
{
    protected $signature   = 'telegram:test:send {message : Text to send}';
    protected $description = 'Send a test message to Telegram channel';

    public function __construct(private readonly TelegramBotService $bot)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $text = (string) $this->argument('message');

        try {
            $this->bot->sendMessage($text);
            $this->info('✅ Sent: ' . $text);
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
