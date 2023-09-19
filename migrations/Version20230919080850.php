<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919080850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_pokemon (type_id INT NOT NULL, pokemon_id INT NOT NULL, PRIMARY KEY(type_id, pokemon_id))');
        $this->addSql('CREATE INDEX IDX_4AFDFF06C54C8C93 ON type_pokemon (type_id)');
        $this->addSql('CREATE INDEX IDX_4AFDFF062FE71C3E ON type_pokemon (pokemon_id)');
        $this->addSql('ALTER TABLE type_pokemon ADD CONSTRAINT FK_4AFDFF06C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_pokemon ADD CONSTRAINT FK_4AFDFF062FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type DROP CONSTRAINT fk_8cde57292fe71c3e');
        $this->addSql('DROP INDEX idx_8cde57292fe71c3e');
        $this->addSql('ALTER TABLE type DROP pokemon_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE type_pokemon DROP CONSTRAINT FK_4AFDFF06C54C8C93');
        $this->addSql('ALTER TABLE type_pokemon DROP CONSTRAINT FK_4AFDFF062FE71C3E');
        $this->addSql('DROP TABLE type_pokemon');
        $this->addSql('ALTER TABLE type ADD pokemon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT fk_8cde57292fe71c3e FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8cde57292fe71c3e ON type (pokemon_id)');
    }
}
