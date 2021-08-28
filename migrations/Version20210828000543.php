<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828000543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE les2joueurswin1set ADD affiche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE les2joueurswin1set ADD CONSTRAINT FK_6C0BEC3848A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
        $this->addSql('CREATE INDEX IDX_6C0BEC3848A60577 ON les2joueurswin1set (affiche_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Les2joueursWin1set DROP FOREIGN KEY FK_6C0BEC3848A60577');
        $this->addSql('DROP INDEX IDX_6C0BEC3848A60577 ON Les2joueursWin1set');
        $this->addSql('ALTER TABLE Les2joueursWin1set DROP affiche_id');
    }
}
