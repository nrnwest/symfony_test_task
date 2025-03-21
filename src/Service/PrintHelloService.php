<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

class PrintHelloService
{
    private const TEMPLATE_PRINT = 'Hello: %s';
    private const TEMPLATE_INVALID = 'Execute the command with your name, for example: php ./bin/console %s YourName';
    private const NAME_COMMAND = 'app:stt';

    public function print(SymfonyStyle $symfonyStyle, ?string $arg): int
    {
        //@TODO избыточный подход можно все делать в команде а если есть сложная логика то можно выносить сюда.
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
