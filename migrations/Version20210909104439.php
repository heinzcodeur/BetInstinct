<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909104439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'deposit\',\'retrait\')');
        $this->addSql('ALTER TABLE user ADD solde_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_2DA17977BC7F70A9 FOREIGN KEY (solde_id) REFERENCES Bankroll (id)');
        $this->addSql('CREATE INDEX IDX_2DA17977BC7F70A9 ON user (solde_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE User DROP FOREIGN KEY FK_2DA17977BC7F70A9');
        $this->addSql('DROP INDEX IDX_2DA17977BC7F70A9 ON User');
        $this->addSql('ALTER TABLE User DROP solde_id');
    }
}
