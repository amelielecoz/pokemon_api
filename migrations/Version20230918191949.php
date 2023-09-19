<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230918191949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP type1');
        $this->addSql('ALTER TABLE pokemon DROP type2');
        $this->addSql('ALTER TABLE type ADD pokemon_id INT NOT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57292FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8CDE57292FE71C3E ON type (pokemon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pokemon ADD type1 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pokemon ADD type2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE type DROP CONSTRAINT FK_8CDE57292FE71C3E');
        $this->addSql('DROP INDEX IDX_8CDE57292FE71C3E');
        $this->addSql('ALTER TABLE type DROP pokemon_id');
    }
}
