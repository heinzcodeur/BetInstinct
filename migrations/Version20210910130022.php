<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910130022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeu ADD parieur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_BAA9CB559FBD62B1 FOREIGN KEY (parieur_id) REFERENCES User (id)');
        $this->addSql('CREATE INDEX IDX_BAA9CB559FBD62B1 ON jeu (parieur_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Jeu DROP FOREIGN KEY FK_BAA9CB559FBD62B1');
        $this->addSql('DROP INDEX IDX_BAA9CB559FBD62B1 ON Jeu');
        $this->addSql('ALTER TABLE Jeu DROP parieur_id');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
