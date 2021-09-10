<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905094357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pari ADD bet_id INT NOT NULL, ADD auteur_id INT NOT NULL, ADD mise DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_8A3BB321D871DC26 FOREIGN KEY (bet_id) REFERENCES Bet (id)');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_8A3BB32160BB6FE6 FOREIGN KEY (auteur_id) REFERENCES User (id)');
        $this->addSql('CREATE INDEX IDX_8A3BB321D871DC26 ON pari (bet_id)');
        $this->addSql('CREATE INDEX IDX_8A3BB32160BB6FE6 ON pari (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pari DROP FOREIGN KEY FK_8A3BB321D871DC26');
        $this->addSql('ALTER TABLE Pari DROP FOREIGN KEY FK_8A3BB32160BB6FE6');
        $this->addSql('DROP INDEX IDX_8A3BB321D871DC26 ON Pari');
        $this->addSql('DROP INDEX IDX_8A3BB32160BB6FE6 ON Pari');
        $this->addSql('ALTER TABLE Pari DROP bet_id, DROP auteur_id, DROP mise');
    }
}
