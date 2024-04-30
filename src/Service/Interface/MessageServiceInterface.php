<?php

declare(strict_types=1);

namespace App\Service\Interface;

use App\Entity\Message;

interface MessageServiceInterface
{
    public function getAll(): array;

    public function create(Message $message): void;

    public function update(Message $message): void;

    public function delete(Message $message): void;
}