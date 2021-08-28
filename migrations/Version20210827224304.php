<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210827224304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Vainqueur (id INT AUTO_INCREMENT NOT NULL, affiche_id INT DEFAULT NULL, favori DOUBLE PRECISION NOT NULL, outsider DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EDDCE6D248A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Vainqueur ADD CONSTRAINT FK_EDDCE6D248A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Vainqueur');
    }
}
