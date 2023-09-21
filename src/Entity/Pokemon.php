<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(),
        new GetCollection(),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: [
    'groups' => ['pokemon:read']
],
    denormalizationContext: [
        'groups' => 'pokemon:write'
    ],
    paginationClientItemsPerPage: true,
    paginationItemsPerPage: 50,
)]
#[UniqueEntity(fields: ['name'], message: 'It looks like another Pokemon already has this name !')]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private int $pokedexId = 0;

    #[ORM\Column(length: 255)]
    #[ApiFilter(SearchFilter::class, strategy: 'ipartial')]
    #[Groups(['pokemon:read', 'pokemon:write'])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 20, maxMessage: 'Give a name to your pokemon, 20 chars or less.')]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $total = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $hitPoint = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $attack = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $defense = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $specialAttack = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $specialDefense = null;

    #[ORM\Column]
    #[Groups(['pokemon:read'])]
    private ?int $speed = null;

    #[ORM\Column]
    #[ApiFilter(NumericFilter::class)]
    #[Groups(['pokemon:read', 'pokemon:write'])]
    #[Assert\GreaterThanOrEqual(1)]
    #[Assert\LessThanOrEqual(6)]
    private ?int $generation = null;

    #[ORM\Column]
    #[ApiFilter(BooleanFilter::class)]
    #[Groups(['pokemon:read', 'pokemon:write'])]
    private bool $legendary = false;

    #[ORM\ManyToMany(targetEntity: Type::class, mappedBy: 'pokemons' )]
    #[ApiFilter(SearchFilter::class, properties: ['types.name' => 'ipartial'])]
    #[Groups(['pokemon:write', 'pokemon:read', 'type:read'])]
    #[Assert\Valid]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

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

    public function getPokedexId(): ?int
    {
        return $this->pokedexId;
    }

    public function setPokedexId(int $pokedexId): static
    {
        $this->pokedexId = $pokedexId;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->addPokemon($this);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        if ($this->types->removeElement($type)) {
            $type->removePokemon($this);
        }

        return $this;
    }
}
