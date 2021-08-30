<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210830133201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type2choix ADD sport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type2choix ADD CONSTRAINT FK_BA731832AC78BCF8 FOREIGN KEY (sport_id) REFERENCES Sport (id)');
        $this->addSql('CREATE INDEX IDX_BA731832AC78BCF8 ON type2choix (sport_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Type2choix DROP FOREIGN KEY FK_BA731832AC78BCF8');
        $this->addSql('DROP INDEX IDX_BA731832AC78BCF8 ON Type2choix');
        $this->addSql('ALTER TABLE Type2choix DROP sport_id');
    }
}
