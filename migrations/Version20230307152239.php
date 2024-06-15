<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307152239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_employer VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL, prenom VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE liste_tache (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_tache VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL)');
        $this->addSql('CREATE TABLE tache (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_tache_id INTEGER NOT NULL, nom_employer_id INTEGER NOT NULL, debut DATE NOT NULL, fin DATE NOT NULL, CONSTRAINT FK_93872075476998B0 FOREIGN KEY (nom_tache_id) REFERENCES liste_tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_938720758FAD3565 FOREIGN KEY (nom_employer_id) REFERENCES employer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93872075476998B0 ON tache (nom_tache_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_938720758FAD3565 ON tache (nom_employer_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employer');
        $this->addSql('DROP TABLE liste_tache');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
