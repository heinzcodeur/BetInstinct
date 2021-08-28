<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825201951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choix ADD pari_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_8E89AF95EE90C4AE FOREIGN KEY (pari_id) REFERENCES Pari (id)');
        $this->addSql('CREATE INDEX IDX_8E89AF95EE90C4AE ON choix (pari_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Choix DROP FOREIGN KEY FK_8E89AF95EE90C4AE');
        $this->addSql('DROP INDEX IDX_8E89AF95EE90C4AE ON Choix');
        $this->addSql('ALTER TABLE Choix DROP pari_id');
    }
}
