<?php

declare(strict_types=1);

namespace App\Utility;

class Log
{
    public static function write($message, $fileName = 'app.log'): void
    {
        $currentDateTime       = new \DateTime();
        $currentDateTimeString = $currentDateTime->format('Y-m-d H:i:s.u');

        $path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'var/log' . DIRECTORY_SEPARATOR . $fileName;
        file_put_contents($path, sprintf("[%s] APP: %s \n", $currentDateTimeString, $message), FILE_APPEND | LOCK_EX);
    }
}
