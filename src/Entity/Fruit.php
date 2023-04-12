<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fruit_genus = null;

    #[ORM\Column(length: 255)]
    private ?string $fruit_name = null;

    #[ORM\Column(length: 255)]
    private ?string $fruit_family = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fruit_order = null;

    #[ORM\Column]
    private ?int $fruit_external_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruitGenus(): ?string
    {
        return $this->fruit_genus;
    }

    public function setFruitGenus(?string $fruit_genus): self
    {
        $this->fruit_genus = $fruit_genus;

        return $this;
    }

    public function getFruitName(): ?string
    {
        return $this->fruit_name;
    }

    public function setFruitName(string $fruit_name): self
    {
        $this->fruit_name = $fruit_name;

        return $this;
    }

    public function getFruitFamily(): ?string
    {
        return $this->fruit_family;
    }

    public function setFruitFamily(string $fruit_family): self
    {
        $this->fruit_family = $fruit_family;

        return $this;
    }

    public function getFruitOrder(): ?string
    {
        return $this->fruit_order;
    }

    public function setFruitOrder(?string $fruit_order): self
    {
        $this->fruit_order = $fruit_order;

        return $this;
    }

    public function getFruitExternalId(): ?int
    {
        return $this->fruit_external_id;
    }

    public function setFruitExternalId(int $fruit_external_id): self
    {
        $this->fruit_external_id = $fruit_external_id;

        return $this;
    }
}
