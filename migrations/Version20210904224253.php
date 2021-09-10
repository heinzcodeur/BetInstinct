<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210904224253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Bankroll (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, balance DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_F0B6980C7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Transaction (id INT AUTO_INCREMENT NOT NULL, auteur_id INT NOT NULL, type VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, date VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F4AB8A0660BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Bankroll ADD CONSTRAINT FK_F0B6980C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Transaction ADD CONSTRAINT FK_F4AB8A0660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Bankroll');
        $this->addSql('DROP TABLE Transaction');
    }
}
