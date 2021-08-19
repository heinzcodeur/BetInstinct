<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818223223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays ADD capitale_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pays ADD CONSTRAINT FK_94AD9390B126FF46 FOREIGN KEY (capitale_id) REFERENCES City (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94AD9390B126FF46 ON pays (capitale_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pays DROP FOREIGN KEY FK_94AD9390B126FF46');
        $this->addSql('DROP INDEX UNIQ_94AD9390B126FF46 ON Pays');
        $this->addSql('ALTER TABLE Pays DROP capitale_id');
    }
}
