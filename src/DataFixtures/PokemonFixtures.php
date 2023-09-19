<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture
{
    const COLUMN_POKEDEX_ID = 0;
    const COLUMN_NAME = 1;
    const COLUMN_TYPE_1 = 2;
    const COLUMN_TYPE_2 = 3;
    const COLUMN_TOTAL = 4;
    const COLUMN_HIT_POINT = 5;
    const COLUMN_ATTACK = 6;
    const COLUMN_DEFENSE = 7;
    const COLUMN_SPECIAL_ATTACK = 8;
    const COLUMN_SPECIAL_DEFENSE = 9;
    const COLUMN_SPEED = 10;
    const COLUMN_GENERATION = 11;
    const COLUMN_LEGENDARY = 12;

    public function __construct(
        private readonly array $data,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $typeRepository = $manager->getRepository(Type::class);
        $pokemon = new Pokemon();

        $pokemon->setPokedexId(intval($this->data[self::COLUMN_POKEDEX_ID]));
        $pokemon->setName($this->data[self::COLUMN_NAME]);

        if ($this->data[self::COLUMN_TYPE_1]) {
            $pokemon->addType($typeRepository->findOneBy(['name' => $this->data[self::COLUMN_TYPE_1]]));
        }

        if ($this->data[self::COLUMN_TYPE_2]) {
            $pokemon->addType($typeRepository->findOneBy(['name' => $this->data[self::COLUMN_TYPE_2]]));
        }

        $pokemon->setTotal(intval($this->data[self::COLUMN_TOTAL]));
        $pokemon->setHitPoint(intval($this->data[self::COLUMN_HIT_POINT]));
        $pokemon->setAttack(intval($this->data[self::COLUMN_ATTACK]));
        $pokemon->setDefense(intval($this->data[self::COLUMN_DEFENSE]));
        $pokemon->setSpecialAttack(intval($this->data[self::COLUMN_SPECIAL_ATTACK]));
        $pokemon->setSpecialDefense(intval($this->data[self::COLUMN_SPECIAL_DEFENSE]));
        $pokemon->setSpeed(intval($this->data[self::COLUMN_SPEED]));
        $pokemon->setGeneration(intval($this->data[self::COLUMN_GENERATION]));
        $pokemon->setLegendary($this->data[self::COLUMN_LEGENDARY]);
        $manager->persist($pokemon);
        $manager->flush();
    }
}
