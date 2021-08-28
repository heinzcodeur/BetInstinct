<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825194404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Choix (id INT AUTO_INCREMENT NOT NULL, type1_id INT DEFAULT NULL, type2_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_8E89AF95BFAFA3E1 (type1_id), INDEX IDX_8E89AF95AD1A0C0F (type2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Choix ADD CONSTRAINT FK_8E89AF95BFAFA3E1 FOREIGN KEY (type1_id) REFERENCES TypePari (id)');
        $this->addSql('ALTER TABLE Choix ADD CONSTRAINT FK_8E89AF95AD1A0C0F FOREIGN KEY (type2_id) REFERENCES TypePari (id)');
        $this->addSql('ALTER TABLE typepari DROP choix');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Choix');
        $this->addSql('ALTER TABLE TypePari ADD choix LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
