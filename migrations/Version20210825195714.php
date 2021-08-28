<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825195714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choix ADD name_id INT DEFAULT NULL, DROP name');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_8E89AF9571179CD6 FOREIGN KEY (name_id) REFERENCES TypePari (id)');
        $this->addSql('CREATE INDEX IDX_8E89AF9571179CD6 ON choix (name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Choix DROP FOREIGN KEY FK_8E89AF9571179CD6');
        $this->addSql('DROP INDEX IDX_8E89AF9571179CD6 ON Choix');
        $this->addSql('ALTER TABLE Choix ADD name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP name_id');
    }
}
