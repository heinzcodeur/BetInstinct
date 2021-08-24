<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822203503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE athlete ADD ranking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE athlete ADD CONSTRAINT FK_F86BABD20F64684 FOREIGN KEY (ranking_id) REFERENCES Classement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F86BABD20F64684 ON athlete (ranking_id)');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_1AB39EBDA3DC7281');
        $this->addSql('DROP INDEX UNIQ_1AB39EBDA3DC7281 ON classement');
        $this->addSql('ALTER TABLE classement DROP joueurs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Athlete DROP FOREIGN KEY FK_F86BABD20F64684');
        $this->addSql('DROP INDEX UNIQ_F86BABD20F64684 ON Athlete');
        $this->addSql('ALTER TABLE Athlete DROP ranking_id');
        $this->addSql('ALTER TABLE Classement ADD joueurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Classement ADD CONSTRAINT FK_1AB39EBDA3DC7281 FOREIGN KEY (joueurs_id) REFERENCES athlete (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1AB39EBDA3DC7281 ON Classement (joueurs_id)');
    }
}
