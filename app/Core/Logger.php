<?php

namespace App\Core;

class Logger
{
    // Mencatat error ke storage/logs/app.log
    // Jangan pernah menulis password / data sensitif ke dalam $context.
    public static function error(string $message, array $context = []): void
    {
        $dir = __DIR__ . '/../../storage/logs';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $line = date('Y-m-d H:i:s') . ' - ERROR - ' . $message;

        if (!empty($context)) {
            $line .= ' ' . json_encode($context, JSON_UNESCAPED_UNICODE);
        }

        error_log($line . PHP_EOL, 3, $dir . '/app.log');
    }
}