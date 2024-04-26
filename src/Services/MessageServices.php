<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;

class MessageServices
{
    public function __construct(
        private MessageRepository $messageRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function getAll(): array
    {
        return $this->messageRepository->findAll();
    }

    public function write(Message $message): void
    {
        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }

    public function update(): void
    {
        $this->entityManager->flush();
    }

    public function delete(Message $message): void
    {
        $this->entityManager->remove($message);
        $this->entityManager->flush();
    }

}