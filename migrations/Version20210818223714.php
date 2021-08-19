<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818223714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Association (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classement ADD association_id INT NOT NULL');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_1AB39EBDEFB9C8A5 FOREIGN KEY (association_id) REFERENCES Association (id)');
        $this->addSql('CREATE INDEX IDX_1AB39EBDEFB9C8A5 ON classement (association_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Classement DROP FOREIGN KEY FK_1AB39EBDEFB9C8A5');
        $this->addSql('DROP TABLE Association');
        $this->addSql('DROP INDEX IDX_1AB39EBDEFB9C8A5 ON Classement');
        $this->addSql('ALTER TABLE Classement DROP association_id');
    }
}
