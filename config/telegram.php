<?php

return [
    'bot_token' => env('TELEGRAM_BOT_TOKEN'),
    'chat_id'   => env('TELEGRAM_CHAT_ID'),
    'api_url'   => rtrim(env('TELEGRAM_API_URL', 'https://api.telegram.org'), '/'),
    'timeout'   => 10, // seconds
];
