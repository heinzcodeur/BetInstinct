<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910135256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction ADD jeu_id INT DEFAULT NULL, CHANGE type type ENUM(\'deposit\',\'retrait\')');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_F4AB8A068C9E392E FOREIGN KEY (jeu_id) REFERENCES Jeu (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4AB8A068C9E392E ON transaction (jeu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Transaction DROP FOREIGN KEY FK_F4AB8A068C9E392E');
        $this->addSql('DROP INDEX UNIQ_F4AB8A068C9E392E ON Transaction');
        $this->addSql('ALTER TABLE Transaction DROP jeu_id, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
