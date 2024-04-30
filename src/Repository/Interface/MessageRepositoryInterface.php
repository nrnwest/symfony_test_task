<?php

declare(strict_types=1);

namespace App\Repository\Interface;

use App\Entity\Message;

interface MessageRepositoryInterface
{
    public function add(Message $message): void;

    public function update(Message $message): void;

    public function delete(Message $message): void;

}