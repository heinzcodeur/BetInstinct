<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106110828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Continent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game CHANGE resultat resultat ENUM(\'en attente\',\'gagnant\',\'perdant\')');
        $this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE pays ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_94AD93909F2C3FAB FOREIGN KEY (zone_id) REFERENCES Continent (id)');
        $this->addSql('CREATE INDEX IDX_94AD93909F2C3FAB ON pays (zone_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pays DROP FOREIGN KEY FK_94AD93909F2C3FAB');
        $this->addSql('DROP TABLE Continent');
        $this->addSql('ALTER TABLE Game CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_94AD93909F2C3FAB ON Pays');
        $this->addSql('ALTER TABLE Pays DROP zone_id');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
