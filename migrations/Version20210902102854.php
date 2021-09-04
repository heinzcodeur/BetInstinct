<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902102854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athlete ADD avatar VARCHAR(255) NOT NULL');
       // $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_F86BABDB4BB6BBC FOREIGN KEY (birth_place_id) REFERENCES City (id)');
       // $this->addSql('CREATE INDEX IDX_F86BABDB4BB6BBC ON athlete (birth_place_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Athlete DROP FOREIGN KEY FK_F86BABDB4BB6BBC');
        $this->addSql('DROP INDEX IDX_F86BABDB4BB6BBC ON Athlete');
        $this->addSql('ALTER TABLE Athlete DROP birth_place_id, DROP avatar');
    }
}
