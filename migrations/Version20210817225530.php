<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817225530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Pari (id INT AUTO_INCREMENT NOT NULL, affiche_id INT NOT NULL, formule_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_8A3BB32148A60577 (affiche_id), INDEX IDX_8A3BB3212A68F4D1 (formule_id), INDEX IDX_8A3BB321C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Pronostic (id INT AUTO_INCREMENT NOT NULL, pari_id INT DEFAULT NULL, INDEX IDX_64BA5E7DEE90C4AE (pari_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Pari ADD CONSTRAINT FK_8A3BB32148A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
        $this->addSql('ALTER TABLE Pari ADD CONSTRAINT FK_8A3BB3212A68F4D1 FOREIGN KEY (formule_id) REFERENCES Formule (id)');
        $this->addSql('ALTER TABLE Pari ADD CONSTRAINT FK_8A3BB321C54C8C93 FOREIGN KEY (type_id) REFERENCES TypePari (id)');
        $this->addSql('ALTER TABLE Pronostic ADD CONSTRAINT FK_64BA5E7DEE90C4AE FOREIGN KEY (pari_id) REFERENCES Pari (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DEE90C4AE');
        $this->addSql('DROP TABLE Pari');
        $this->addSql('DROP TABLE Pronostic');
    }
}
