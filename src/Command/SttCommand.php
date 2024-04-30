<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\PrintHelloService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:stt',
    description: 'print Hello YourName',
)]
class SttCommand extends Command
{
    public function __construct(private readonly PrintHelloService $printHelloServices)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('arg1', InputArgument::OPTIONAL, 'YourName');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       return $this->printHelloServices->print(new SymfonyStyle($input, $output), $input->getArgument('arg1'));
    }
}
