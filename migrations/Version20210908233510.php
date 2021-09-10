<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210908233510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pari ADD mise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_8A3BB321737C2DC5 FOREIGN KEY (mise_id) REFERENCES Transaction (id)');
        $this->addSql('CREATE INDEX IDX_8A3BB321737C2DC5 ON pari (mise_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pari DROP FOREIGN KEY FK_8A3BB321737C2DC5');
        $this->addSql('DROP INDEX IDX_8A3BB321737C2DC5 ON Pari');
        $this->addSql('ALTER TABLE Pari DROP mise_id');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
