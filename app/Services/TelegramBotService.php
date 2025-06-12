<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

final readonly class TelegramBotService
{
    public function __construct(
        private string $token,
        private string|int $chatId,
        private string $apiUrl,
        private int $timeout,
    ) {
    }

    /** Отправка обычного текстового сообщения */
    public function sendMessage(string $text, array $opts = []): void
    {
        $payload = array_merge([
            'chat_id'                  => $this->chatId,
            'text'                     => $text,
            'parse_mode'               => 'HTML',
            'disable_web_page_preview' => true,
        ], $opts);

        $endpoint = "{$this->apiUrl}/bot{$this->token}/sendMessage";

        Http::timeout($this->timeout)
            ->acceptJson()
            ->post($endpoint, $payload)
            ->throw()
            ->json();
    }
}
