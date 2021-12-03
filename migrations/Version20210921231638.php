<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921231638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Transactiob (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD isConfirm TINYINT(1) DEFAULT NULL, CHANGE resultat resultat ENUM(\'en attente\',\'gagnant\',\'perdant\')');
        $this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DA6E256C5 FOREIGN KEY (game1_id) REFERENCES Game (id)');
        $this->addSql('ALTER TABLE transaction ADD game_id INT DEFAULT NULL, CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_F4AB8A06E48FD905 FOREIGN KEY (game_id) REFERENCES Game (id)');
        $this->addSql('CREATE INDEX IDX_F4AB8A06E48FD905 ON transaction (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Transactiob');
        $this->addSql('ALTER TABLE Game DROP isConfirm, CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DA6E256C5');
        $this->addSql('ALTER TABLE Transaction DROP FOREIGN KEY FK_F4AB8A06E48FD905');
        $this->addSql('DROP INDEX IDX_F4AB8A06E48FD905 ON Transaction');
        $this->addSql('ALTER TABLE Transaction DROP game_id, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
