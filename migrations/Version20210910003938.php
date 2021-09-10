<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910003938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Jeu (id INT AUTO_INCREMENT NOT NULL, formule_id INT NOT NULL, pronostic_id INT NOT NULL, mise DOUBLE PRECISION NOT NULL, INDEX IDX_BAA9CB552A68F4D1 (formule_id), UNIQUE INDEX UNIQ_BAA9CB552DD5CFE7 (pronostic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Jeu ADD CONSTRAINT FK_BAA9CB552A68F4D1 FOREIGN KEY (formule_id) REFERENCES Formule (id)');
        $this->addSql('ALTER TABLE Jeu ADD CONSTRAINT FK_BAA9CB552DD5CFE7 FOREIGN KEY (pronostic_id) REFERENCES Pronostic (id)');
        $this->addSql('ALTER TABLE pronostic ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DF675F31B FOREIGN KEY (author_id) REFERENCES User (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DF675F31B ON pronostic (author_id)');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'deposit\',\'retrait\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Jeu');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DF675F31B');
        $this->addSql('DROP INDEX IDX_64BA5E7DF675F31B ON Pronostic');
        $this->addSql('ALTER TABLE Pronostic DROP author_id');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
