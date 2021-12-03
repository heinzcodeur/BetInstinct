<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929171857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affiche ADD equipeA_id INT DEFAULT NULL, ADD EquipeB_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE affiche ADD CONSTRAINT FK_2B8C7691295A3090 FOREIGN KEY (equipeA_id) REFERENCES Equipe (id)');
        $this->addSql('ALTER TABLE affiche ADD CONSTRAINT FK_2B8C769174B29CAE FOREIGN KEY (EquipeB_id) REFERENCES Equipe (id)');
        $this->addSql('CREATE INDEX IDX_2B8C7691295A3090 ON affiche (equipeA_id)');
        $this->addSql('CREATE INDEX IDX_2B8C769174B29CAE ON affiche (EquipeB_id)');
        $this->addSql('ALTER TABLE game CHANGE resultat resultat ENUM(\'en attente\',\'gagnant\',\'perdant\')');
        $this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Affiche DROP FOREIGN KEY FK_2B8C7691295A3090');
        $this->addSql('ALTER TABLE Affiche DROP FOREIGN KEY FK_2B8C769174B29CAE');
        $this->addSql('DROP INDEX IDX_2B8C7691295A3090 ON Affiche');
        $this->addSql('DROP INDEX IDX_2B8C769174B29CAE ON Affiche');
        $this->addSql('ALTER TABLE Affiche DROP equipeA_id, DROP EquipeB_id');
        $this->addSql('ALTER TABLE Game CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
