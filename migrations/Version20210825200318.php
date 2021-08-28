<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825200318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_8E89AF95AD1A0C0F');
        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_8E89AF95BFAFA3E1');
        $this->addSql('DROP INDEX IDX_8E89AF95AD1A0C0F ON choix');
        $this->addSql('DROP INDEX IDX_8E89AF95BFAFA3E1 ON choix');
        $this->addSql('ALTER TABLE choix ADD choix1 VARCHAR(255) NOT NULL, ADD choix2 VARCHAR(255) NOT NULL, DROP type1_id, DROP type2_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Choix ADD type1_id INT DEFAULT NULL, ADD type2_id INT DEFAULT NULL, DROP choix1, DROP choix2');
        $this->addSql('ALTER TABLE Choix ADD CONSTRAINT FK_8E89AF95AD1A0C0F FOREIGN KEY (type2_id) REFERENCES typepari (id)');
        $this->addSql('ALTER TABLE Choix ADD CONSTRAINT FK_8E89AF95BFAFA3E1 FOREIGN KEY (type1_id) REFERENCES typepari (id)');
        $this->addSql('CREATE INDEX IDX_8E89AF95AD1A0C0F ON Choix (type2_id)');
        $this->addSql('CREATE INDEX IDX_8E89AF95BFAFA3E1 ON Choix (type1_id)');
    }
}
