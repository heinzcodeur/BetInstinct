<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210827161635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE typopari ADD affiche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE typopari ADD CONSTRAINT FK_768136CD48A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
        $this->addSql('CREATE INDEX IDX_768136CD48A60577 ON typopari (affiche_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE TypoPari DROP FOREIGN KEY FK_768136CD48A60577');
        $this->addSql('DROP INDEX IDX_768136CD48A60577 ON TypoPari');
        $this->addSql('ALTER TABLE TypoPari DROP affiche_id');
    }
}
