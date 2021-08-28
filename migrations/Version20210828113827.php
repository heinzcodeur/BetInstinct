<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828113827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Bet (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, affiche_id INT DEFAULT NULL, INDEX IDX_C3BDAA7BC54C8C93 (type_id), INDEX IDX_C3BDAA7B48A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Type2choix (id INT AUTO_INCREMENT NOT NULL, choix1 VARCHAR(255) DEFAULT NULL, choix2 VARCHAR(255) DEFAULT NULL, choix3 VARCHAR(255) DEFAULT NULL, choix4 VARCHAR(255) DEFAULT NULL, choix5 VARCHAR(255) DEFAULT NULL, choix6 VARCHAR(255) DEFAULT NULL, choix7 VARCHAR(255) DEFAULT NULL, choix8 VARCHAR(255) DEFAULT NULL, choix9 VARCHAR(255) DEFAULT NULL, choix10 VARCHAR(255) DEFAULT NULL, choix11 VARCHAR(255) DEFAULT NULL, choix12 VARCHAR(255) DEFAULT NULL, choix13 VARCHAR(255) DEFAULT NULL, choix14 VARCHAR(255) DEFAULT NULL, choix15 VARCHAR(255) DEFAULT NULL, choix16 VARCHAR(255) DEFAULT NULL, choix17 VARCHAR(255) DEFAULT NULL, choix18 VARCHAR(255) DEFAULT NULL, choix19 VARCHAR(255) DEFAULT NULL, choix20 VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TypedePari (id INT AUTO_INCREMENT NOT NULL, type2choix_id INT DEFAULT NULL, INDEX IDX_13631054B9C7075E (type2choix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Bet ADD CONSTRAINT FK_C3BDAA7BC54C8C93 FOREIGN KEY (type_id) REFERENCES Type2Pari (id)');
        $this->addSql('ALTER TABLE Bet ADD CONSTRAINT FK_C3BDAA7B48A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
        $this->addSql('ALTER TABLE TypedePari ADD CONSTRAINT FK_13631054B9C7075E FOREIGN KEY (type2choix_id) REFERENCES Type2choix (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE TypedePari DROP FOREIGN KEY FK_13631054B9C7075E');
        $this->addSql('DROP TABLE Bet');
        $this->addSql('DROP TABLE Type2choix');
        $this->addSql('DROP TABLE TypedePari');
    }
}
