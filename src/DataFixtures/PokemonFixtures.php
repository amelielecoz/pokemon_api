<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

;

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

    public function __construct(private readonly string $filepath) {}

    public function load(ObjectManager $manager): void
    {
        $row = 1;
        if(($handle = fopen($this->filepath, "r")) !== false) {
            $flag = true;
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if($flag) { $flag = false; continue; } //allows to skip headers (first row)
                $row++;
                $pokemon = new Pokemon();
                $pokemon->setPokedexId(intval($data[self::COLUMN_POKEDEX_ID]));
                $pokemon->setName($data[self::COLUMN_NAME]);
                $pokemon->setType1($data[self::COLUMN_TYPE_1]);
                $pokemon->setType2($data[self::COLUMN_TYPE_2]);
                $pokemon->setTotal(intval($data[self::COLUMN_TOTAL]));
                $pokemon->setHitPoint(intval($data[self::COLUMN_HIT_POINT]));
                $pokemon->setAttack(intval($data[self::COLUMN_ATTACK]));
                $pokemon->setDefense(intval($data[self::COLUMN_DEFENSE]));
                $pokemon->setSpecialAttack(intval($data[self::COLUMN_SPECIAL_ATTACK]));
                $pokemon->setSpecialDefense(intval($data[self::COLUMN_SPECIAL_DEFENSE]));
                $pokemon->setSpeed(intval($data[self::COLUMN_SPEED]));
                $pokemon->setGeneration(intval($data[self::COLUMN_GENERATION]));
                $pokemon->setLegendary($data[self::COLUMN_LEGENDARY]);
                $manager->persist($pokemon);
                $manager->flush();
            }
            fclose($handle);
        }


    }
}
