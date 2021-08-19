<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818222314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_8D69AD0AA6E44244 FOREIGN KEY (pays_id) REFERENCES Pays (id)');
        $this->addSql('CREATE INDEX IDX_8D69AD0AA6E44244 ON city (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE City DROP FOREIGN KEY FK_8D69AD0AA6E44244');
        $this->addSql('DROP INDEX IDX_8D69AD0AA6E44244 ON City');
        $this->addSql('ALTER TABLE City DROP pays_id');
    }
}
