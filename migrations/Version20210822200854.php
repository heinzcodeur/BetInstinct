<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822200854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athlete DROP FOREIGN KEY FK_F86BABD20F64684');
        $this->addSql('DROP INDEX IDX_F86BABD20F64684 ON athlete');
        $this->addSql('ALTER TABLE athlete DROP ranking_id');
        $this->addSql('ALTER TABLE classement ADD joueurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_1AB39EBDA3DC7281 FOREIGN KEY (joueurs_id) REFERENCES Athlete (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1AB39EBDA3DC7281 ON classement (joueurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Athlete ADD ranking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Athlete ADD CONSTRAINT FK_F86BABD20F64684 FOREIGN KEY (ranking_id) REFERENCES classement (id)');
        $this->addSql('CREATE INDEX IDX_F86BABD20F64684 ON Athlete (ranking_id)');
        $this->addSql('ALTER TABLE Classement DROP FOREIGN KEY FK_1AB39EBDA3DC7281');
        $this->addSql('DROP INDEX UNIQ_1AB39EBDA3DC7281 ON Classement');
        $this->addSql('ALTER TABLE Classement DROP joueurs_id');
    }
}
