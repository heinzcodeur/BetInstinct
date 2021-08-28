<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825185420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pari DROP FOREIGN KEY FK_8A3BB3212A68F4D1');
        $this->addSql('DROP INDEX IDX_8A3BB3212A68F4D1 ON pari');
        $this->addSql('ALTER TABLE pari DROP formule_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pari ADD formule_id INT NOT NULL');
        $this->addSql('ALTER TABLE Pari ADD CONSTRAINT FK_8A3BB3212A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id)');
        $this->addSql('CREATE INDEX IDX_8A3BB3212A68F4D1 ON Pari (formule_id)');
    }
}
