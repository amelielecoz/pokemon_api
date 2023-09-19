<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly string          $filepath,
        private readonly OutputInterface $output,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $row = 1;
        if(($handle = fopen($this->filepath, "r")) !== false) {
            $flag = true;
            $types = [];

            $fp = file($this->filepath, FILE_SKIP_EMPTY_LINES);
            $lines = count($fp) - 1;

            $progressBar = new ProgressBar($this->output, $lines);

            // starts and displays the progress bar
            $progressBar->start();
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if($flag) { $flag = false; continue; } //allows to skip headers (first row)
                $row++;
                $progressBar->advance();

                $type1Name = $data[2];
                $type2Name = $data[3];

                if (!in_array($type1Name, $types) && $type1Name) {
                    $types[] = $data[2];
                    $type1 = new Type();
                    $type1->setName($type1Name);
                    $manager->persist($type1);

                    $manager->flush();
                }

                if (!in_array($type2Name, $types) && $type2Name) {
                    $types[] = $data[3];
                    $type2 = new Type();
                    $type2->setName($type2Name);
                    $manager->persist($type2);

                    $manager->flush();
                }

                $pokemonFixture = new PokemonFixtures($data);
                $pokemonFixture->load($manager);
            }

            fclose($handle);
            $progressBar->finish();
        }
    }
}
