<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Species::class, inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Species $espece = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sixMonthsDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEspece(): ?Species
    {
        return $this->espece;
    }

    public function setEspece(?Species $espece): static
    {
        $this->espece = $espece;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getSixMonthsDate(): ?\DateTimeInterface
    {
        return $this->sixMonthsDate;
    }

    public function setSixMonthsDate(?\DateTimeInterface $sixMonthsDate): static
    {
        $this->sixMonthsDate = $sixMonthsDate;

        return $this;
    }
}
