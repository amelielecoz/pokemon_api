<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
#[ApiResource]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type2 = null;

    #[ORM\Column]
    private ?int $total = null;

    #[ORM\Column]
    private ?int $hitPoint = null;

    #[ORM\Column]
    private ?int $attack = null;

    #[ORM\Column]
    private ?int $defense = null;

    #[ORM\Column]
    private ?int $specialAttack = null;

    #[ORM\Column]
    private ?int $specialDefense = null;

    #[ORM\Column]
    private ?int $speed = null;

    #[ORM\Column]
    private ?int $generation = null;

    #[ORM\Column]
    private ?bool $legendary = null;

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

    public function getType1(): ?string
    {
        return $this->type1;
    }

    public function setType1(string $type1): static
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): ?string
    {
        return $this->type2;
    }

    public function setType2(?string $type2): static
    {
        $this->type2 = $type2;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getHitPoint(): ?int
    {
        return $this->hitPoint;
    }

    public function setHitPoint(int $hitPoint): static
    {
        $this->hitPoint = $hitPoint;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): static
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getSpecialAttack(): ?int
    {
        return $this->specialAttack;
    }

    public function setSpecialAttack(int $specialAttack): static
    {
        $this->specialAttack = $specialAttack;

        return $this;
    }

    public function getSpecialDefense(): ?int
    {
        return $this->specialDefense;
    }

    public function setSpecialDefense(int $specialDefense): static
    {
        $this->specialDefense = $specialDefense;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): static
    {
        $this->speed = $speed;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(int $generation): static
    {
        $this->generation = $generation;

        return $this;
    }

    public function isLegendary(): ?bool
    {
        return $this->legendary;
    }

    public function setLegendary(bool $legendary): static
    {
        $this->legendary = $legendary;

        return $this;
    }
}
