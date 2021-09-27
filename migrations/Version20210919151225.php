<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210919151225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_BAA9CB554226470C');
       // $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_BAA9CB55FA9A2069');
       // $this->addSql('DROP INDEX UNIQ_BAA9CB55FA9A2069 ON jeu');
       //$this->addSql('DROP INDEX UNIQ_BAA9CB554226470C ON jeu');
      //  $this->addSql('ALTER TABLE jeu DROP pronostic2_id, DROP pronostic3_id, CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE pronostic CHANGE game1_id game1_id INT NOT NULL');
        //$this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DA6E256C5 FOREIGN KEY (game1_id) REFERENCES Game (id)');
        //$this->addSql('CREATE INDEX IDX_64BA5E7DA6E256C5 ON pronostic (game1_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Jeu ADD pronostic2_id INT DEFAULT NULL, ADD pronostic3_id INT DEFAULT NULL, CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Jeu ADD CONSTRAINT FK_BAA9CB554226470C FOREIGN KEY (pronostic3_id) REFERENCES pronostic (id)');
        $this->addSql('ALTER TABLE Jeu ADD CONSTRAINT FK_BAA9CB55FA9A2069 FOREIGN KEY (pronostic2_id) REFERENCES pronostic (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BAA9CB55FA9A2069 ON Jeu (pronostic2_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BAA9CB554226470C ON Jeu (pronostic3_id)');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DA6E256C5');
        $this->addSql('DROP INDEX IDX_64BA5E7DA6E256C5 ON Pronostic');
        $this->addSql('ALTER TABLE Pronostic CHANGE game1_id game1_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
