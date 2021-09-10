<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910005107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pronostic DROP FOREIGN KEY FK_64BA5E7DEE90C4AE');
        $this->addSql('DROP INDEX IDX_64BA5E7DEE90C4AE ON pronostic');
        $this->addSql('ALTER TABLE pronostic DROP pari_id');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pronostic ADD pari_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Pronostic ADD CONSTRAINT FK_64BA5E7DEE90C4AE FOREIGN KEY (pari_id) REFERENCES pari (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DEE90C4AE ON Pronostic (pari_id)');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
