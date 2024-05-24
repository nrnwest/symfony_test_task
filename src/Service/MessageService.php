<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\MessageData;
use App\Entity\Message;
use App\Factory\MessageFactory;
use App\Repository\Interface\MessageRepositoryInterface;
use App\Repository\MessageRepository;
use App\Service\Interface\MessageServiceInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class MessageService implements MessageServiceInterface
{
    private EntityManagerInterface $entityManager;
    private ServiceEntityRepository $messageRepository;

    public function __construct(EntityManagerInterface $entityManager, MessageRepositoryInterface $messageRepository)
    {
        $this->entityManager = $entityManager;
        $this->messageRepository = $messageRepository;
    }

    public function getAll(): array
    {
        return $this->messageRepository->findAll();
    }

    public function create(Message $message): void
    {
        $this->messageRepository->add($message);
        $this->entityManager->flush();
    }

    public function update(Message $message): void
    {
        $this->messageRepository->update($message);
        $this->entityManager->flush();
    }

    public function delete(Message $message): void
    {
        $this->messageRepository->delete($message);
        $this->entityManager->flush();
    }

}