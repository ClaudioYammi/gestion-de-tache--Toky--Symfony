<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311134648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tache AS SELECT id, nom_tache_id, nom_employer_id, debut, fin FROM tache');
        $this->addSql('DROP TABLE tache');
        $this->addSql('CREATE TABLE tache (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_tache_id INTEGER NOT NULL, nom_employer_id INTEGER NOT NULL, debut TIME NOT NULL, fin TIME NOT NULL, date_ajout DATE NOT NULL, CONSTRAINT FK_93872075476998B0 FOREIGN KEY (nom_tache_id) REFERENCES liste_tache (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_938720758FAD3565 FOREIGN KEY (nom_employer_id) REFERENCES employer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tache (id, nom_tache_id, nom_employer_id, debut, fin) SELECT id, nom_tache_id, nom_employer_id, debut, fin FROM __temp__tache');
        $this->addSql('DROP TABLE __temp__tache');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_938720758FAD3565 ON tache (nom_employer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93872075476998B0 ON tache (nom_tache_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tache AS SELECT id, nom_tache_id, nom_employer_id, debut, fin FROM tache');
        $this->addSql('DROP TABLE tache');
        $this->addSql('CREATE TABLE tache (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_tache_id INTEGER NOT NULL, nom_employer_id INTEGER NOT NULL, debut DATE NOT NULL, fin DATE NOT NULL, CONSTRAINT FK_93872075476998B0 FOREIGN KEY (nom_tache_id) REFERENCES liste_tache (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_938720758FAD3565 FOREIGN KEY (nom_employer_id) REFERENCES employer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tache (id, nom_tache_id, nom_employer_id, debut, fin) SELECT id, nom_tache_id, nom_employer_id, debut, fin FROM __temp__tache');
        $this->addSql('DROP TABLE __temp__tache');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93872075476998B0 ON tache (nom_tache_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_938720758FAD3565 ON tache (nom_employer_id)');
    }
}
