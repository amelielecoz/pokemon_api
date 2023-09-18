<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230918121616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE pokemon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pokemon (id INT NOT NULL, name VARCHAR(255) NOT NULL, type1 VARCHAR(255) NOT NULL, type2 VARCHAR(255) DEFAULT NULL, total INT NOT NULL, hit_point INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, special_attack INT NOT NULL, special_defense INT NOT NULL, speed INT NOT NULL, generation INT NOT NULL, legendary BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE pokemon_id_seq CASCADE');
        $this->addSql('DROP TABLE pokemon');
    }
}
