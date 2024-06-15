<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311135620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__employer AS SELECT id, nom_employer, poste, adresse, telephone, date_ajout, prenom FROM employer');
        $this->addSql('DROP TABLE employer');
        $this->addSql('CREATE TABLE employer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_employer VARCHAR(255) NOT NULL, poste VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL, prenom VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO employer (id, nom_employer, poste, adresse, telephone, date_ajout, prenom) SELECT id, nom_employer, poste, adresse, telephone, date_ajout, prenom FROM __temp__employer');
        $this->addSql('DROP TABLE __temp__employer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__employer AS SELECT id, nom_employer, poste, adresse, telephone, date_ajout, prenom FROM employer');
        $this->addSql('DROP TABLE employer');
        $this->addSql('CREATE TABLE employer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_employer VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL, prenom VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO employer (id, nom_employer, poste, adresse, telephone, date_ajout, prenom) SELECT id, nom_employer, poste, adresse, telephone, date_ajout, prenom FROM __temp__employer');
        $this->addSql('DROP TABLE __temp__employer');
    }
}
