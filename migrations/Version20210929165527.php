<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929165527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Equipe (id INT AUTO_INCREMENT NOT NULL, sport_id INT NOT NULL, pays_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_23E5BF23AC78BCF8 (sport_id), INDEX IDX_23E5BF23A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe_athlete (equipe_id INT NOT NULL, athlete_id INT NOT NULL, INDEX IDX_183B9F9D6D861B89 (equipe_id), INDEX IDX_183B9F9DFE6BCB8B (athlete_id), PRIMARY KEY(equipe_id, athlete_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Equipe ADD CONSTRAINT FK_23E5BF23AC78BCF8 FOREIGN KEY (sport_id) REFERENCES Sport (id)');
        $this->addSql('ALTER TABLE Equipe ADD CONSTRAINT FK_23E5BF23A6E44244 FOREIGN KEY (pays_id) REFERENCES Pays (id)');
        $this->addSql('ALTER TABLE equipe_athlete ADD CONSTRAINT FK_183B9F9D6D861B89 FOREIGN KEY (equipe_id) REFERENCES Equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_athlete ADD CONSTRAINT FK_183B9F9DFE6BCB8B FOREIGN KEY (athlete_id) REFERENCES Athlete (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game CHANGE resultat resultat ENUM(\'en attente\',\'gagnant\',\'perdant\')');
        $this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe_athlete DROP FOREIGN KEY FK_183B9F9D6D861B89');
        $this->addSql('DROP TABLE Equipe');
        $this->addSql('DROP TABLE equipe_athlete');
        $this->addSql('ALTER TABLE Game CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
