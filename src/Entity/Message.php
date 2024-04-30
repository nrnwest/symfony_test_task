<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\Interface\MessageRepositoryInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'messages'), ORM\Entity(repositoryClass: MessageRepositoryInterface::class), ORM\HasLifecycleCallbacks]
class Message
{
    #[ORM\Id, ORM\GeneratedValue('AUTO'), ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 255
    )]
    private string $subject;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 20,
        max: 4000
    )]
    private string $body;

    #[ORM\Column(type: "datetime_immutable", nullable: false)]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(type: "datetime_immutable", nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: true, onDelete: 'cascade')]
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->setCreateAt(new \DateTimeImmutable());
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->setUpdatedAt(new \DateTimeImmutable());
    }
}
