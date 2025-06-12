<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\PublishTestMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RabbitMQTestPublish extends Command
{
    protected $signature   = 'rabbitmq:test:publish';
    protected $description = 'Publish a dummy message into confirm.codes queue';

    public function handle(): int
    {
        $payload = ['uuid' => Str::uuid()->toString(), 'ts' => now()->toDateTimeString()];

        PublishTestMessage::dispatch($payload)
            ->onConnection('rabbitmq')
            ->onQueue('confirm.codes');

        $this->info('Message published: ' . json_encode($payload));

        return self::SUCCESS;
    }
}
