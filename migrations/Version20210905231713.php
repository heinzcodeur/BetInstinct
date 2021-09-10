<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905231713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association ADD sport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE association ADD CONSTRAINT FK_7B19AE1BAC78BCF8 FOREIGN KEY (sport_id) REFERENCES Sport (id)');
        $this->addSql('CREATE INDEX IDX_7B19AE1BAC78BCF8 ON association (sport_id)');
        $this->addSql('ALTER TABLE transaction DROP date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Association DROP FOREIGN KEY FK_7B19AE1BAC78BCF8');
        $this->addSql('DROP INDEX IDX_7B19AE1BAC78BCF8 ON Association');
        $this->addSql('ALTER TABLE Association DROP sport_id');
        $this->addSql('ALTER TABLE Transaction ADD date VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
