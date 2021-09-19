<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210914230428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE pronostic ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DE48FD905 FOREIGN KEY (game_id) REFERENCES Jeu (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DE48FD905 ON pronostic (game_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DE48FD905');
        $this->addSql('DROP INDEX IDX_64BA5E7DE48FD905 ON Pronostic');
        $this->addSql('ALTER TABLE Pronostic DROP game_id');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
