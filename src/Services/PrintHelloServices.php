<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class PrintHelloServices
{
    private const TEMPLATE_PRINT = 'Hello: %s';
    private const TEMPLATE_INVALID = 'Execute the command with your name, for example: php ./bin/console %s YourName';
    private const NAME_COMMAND = 'app:stt';

    public function print(SymfonyStyle $symfonyStyle, ?string $arg): int
    {
        if ($arg) {
            while (true) {
                $symfonyStyle->text(sprintf(self::TEMPLATE_PRINT, $arg));
                sleep(1);
            }
        } else {
            $symfonyStyle->note(
                sprintf(self::TEMPLATE_INVALID, self::NAME_COMMAND)
            );

            return Command::INVALID;
        }
    }
}
