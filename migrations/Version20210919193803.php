<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210919193803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE game ADD formule_id INT DEFAULT NULL, ADD parieur_id INT DEFAULT NULL, ADD cote_totale DOUBLE PRECISION DEFAULT NULL, ADD mise DOUBLE PRECISION DEFAULT NULL, ADD resultat ENUM(\'en attente\',\'gagnant\',\'perdant\'), ADD gain DOUBLE PRECISION DEFAULT NULL');
        //$this->addSql('ALTER TABLE game ADD CONSTRAINT FK_83199EB22A68F4D1 FOREIGN KEY (formule_id) REFERENCES Formule (id)');
        //$this->addSql('ALTER TABLE game ADD CONSTRAINT FK_83199EB29FBD62B1 FOREIGN KEY (parieur_id) REFERENCES User (id)');
        //$this->addSql('CREATE INDEX IDX_83199EB22A68F4D1 ON game (formule_id)');
        //$this->addSql('CREATE INDEX IDX_83199EB29FBD62B1 ON game (parieur_id)');
        //$this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        //$this->addSql('ALTER TABLE pronostic DROP FOREIGN KEY FK_64BA5E7DE48FD905');
        //$this->addSql('DROP INDEX IDX_64BA5E7DE48FD905 ON pronostic');
        //$this->addSql('ALTER TABLE pronostic DROP game_id');
        //$this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DA6E256C5 FOREIGN KEY (game1_id) REFERENCES Game (id)');
        //$this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Game DROP FOREIGN KEY FK_83199EB22A68F4D1');
        $this->addSql('ALTER TABLE Game DROP FOREIGN KEY FK_83199EB29FBD62B1');
        $this->addSql('DROP INDEX IDX_83199EB22A68F4D1 ON Game');
        $this->addSql('DROP INDEX IDX_83199EB29FBD62B1 ON Game');
        $this->addSql('ALTER TABLE Game DROP formule_id, DROP parieur_id, DROP cote_totale, DROP mise, DROP resultat, DROP gain');
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DA6E256C5');
        $this->addSql('ALTER TABLE Pronostic ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Pronostic ADD CONSTRAINT FK_64BA5E7DE48FD905 FOREIGN KEY (game_id) REFERENCES jeu (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DE48FD905 ON Pronostic (game_id)');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
