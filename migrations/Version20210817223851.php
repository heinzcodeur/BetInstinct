<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817223851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Classement (id INT AUTO_INCREMENT NOT NULL, association VARCHAR(255) NOT NULL, ranking INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE FormulePari (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TypePari (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, cotes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE athlete ADD ranking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_F86BABD20F64684 FOREIGN KEY (ranking_id) REFERENCES Classement (id)');
        $this->addSql('CREATE INDEX IDX_F86BABD20F64684 ON athlete (ranking_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Athlete DROP FOREIGN KEY FK_F86BABD20F64684');
        $this->addSql('DROP TABLE Classement');
        $this->addSql('DROP TABLE FormulePari');
        $this->addSql('DROP TABLE TypePari');
        $this->addSql('DROP INDEX IDX_F86BABD20F64684 ON Athlete');
        $this->addSql('ALTER TABLE Athlete DROP ranking_id');
    }
}
