<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210913221326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeu ADD pronostic2_id INT DEFAULT NULL, ADD pronostic3_id INT DEFAULT NULL, ADD cote_totale DOUBLE PRECISION DEFAULT NULL, CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_BAA9CB55FA9A2069 FOREIGN KEY (pronostic2_id) REFERENCES Pronostic (id)');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_BAA9CB554226470C FOREIGN KEY (pronostic3_id) REFERENCES Pronostic (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BAA9CB55FA9A2069 ON jeu (pronostic2_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BAA9CB554226470C ON jeu (pronostic3_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Jeu DROP FOREIGN KEY FK_BAA9CB55FA9A2069');
        $this->addSql('ALTER TABLE Jeu DROP FOREIGN KEY FK_BAA9CB554226470C');
        $this->addSql('DROP INDEX UNIQ_BAA9CB55FA9A2069 ON Jeu');
        $this->addSql('DROP INDEX UNIQ_BAA9CB554226470C ON Jeu');
        $this->addSql('ALTER TABLE Jeu DROP pronostic2_id, DROP pronostic3_id, DROP cote_totale, CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
