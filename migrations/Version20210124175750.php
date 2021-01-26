<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124175750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE planet (reference CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', star_reference CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(128) NOT NULL, mass INT NOT NULL, distance INT NOT NULL, INDEX IDX_68136AA528F4B266 (star_reference), PRIMARY KEY(reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solar_system (reference CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(128) NOT NULL, PRIMARY KEY(reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE star (reference CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', solar_system_reference CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(128) NOT NULL, mass INT NOT NULL, INDEX IDX_C9DB5A1414F9ED1C (solar_system_reference), PRIMARY KEY(reference)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE planet ADD CONSTRAINT FK_68136AA528F4B266 FOREIGN KEY (star_reference) REFERENCES star (reference) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE star ADD CONSTRAINT FK_C9DB5A1414F9ED1C FOREIGN KEY (solar_system_reference) REFERENCES solar_system (reference) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE star DROP FOREIGN KEY FK_C9DB5A1414F9ED1C');
        $this->addSql('ALTER TABLE planet DROP FOREIGN KEY FK_68136AA528F4B266');
        $this->addSql('DROP TABLE planet');
        $this->addSql('DROP TABLE solar_system');
        $this->addSql('DROP TABLE star');
    }
}
