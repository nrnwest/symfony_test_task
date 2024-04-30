<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Message;
use App\Repository\Interface\MessageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository implements MessageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function add(Message $message): void
    {
        $this->getEntityManager()->persist($message);
    }

    public function update(Message $message): void
    {
        $this->getEntityManager()->persist($message);
    }

    public function delete(Message $message): void
    {
        $this->getEntityManager()->remove($message);
    }

}
