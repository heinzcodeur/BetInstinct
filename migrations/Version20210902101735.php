<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902101735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pari DROP FOREIGN KEY FK_8A3BB32148A60577');
        $this->addSql('ALTER TABLE pari DROP FOREIGN KEY FK_8A3BB321C54C8C93');
        $this->addSql('DROP INDEX IDX_8A3BB321C54C8C93 ON pari');
        $this->addSql('DROP INDEX IDX_8A3BB32148A60577 ON pari');
        $this->addSql('ALTER TABLE pari ADD formule_id INT NOT NULL, DROP affiche_id, DROP type_id');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_8A3BB3212A68F4D1 FOREIGN KEY (formule_id) REFERENCES Formule (id)');
        $this->addSql('CREATE INDEX IDX_8A3BB3212A68F4D1 ON pari (formule_id)');
        $this->addSql('ALTER TABLE pronostic DROP FOREIGN KEY FK_64BA5E7D48A60577');
        $this->addSql('DROP INDEX IDX_64BA5E7D48A60577 ON pronostic');
        $this->addSql('ALTER TABLE pronostic ADD pari_id INT DEFAULT NULL, DROP affiche_id');
        $this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DEE90C4AE FOREIGN KEY (pari_id) REFERENCES Pari (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DEE90C4AE ON pronostic (pari_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pari DROP FOREIGN KEY FK_8A3BB3212A68F4D1');
        $this->addSql('DROP INDEX IDX_8A3BB3212A68F4D1 ON Pari');
        $this->addSql('ALTER TABLE Pari ADD type_id INT NOT NULL, CHANGE formule_id affiche_id INT NOT NULL');
        $this->addSql('ALTER TABLE Pari ADD CONSTRAINT FK_8A3BB32148A60577 FOREIGN KEY (affiche_id) REFERENCES affiche (id)');
        $this->addSql('ALTER TABLE Pari ADD CONSTRAINT FK_8A3BB321C54C8C93 FOREIGN KEY (type_id) REFERENCES typepari (id)');
        $this->addSql('CREATE INDEX IDX_8A3BB321C54C8C93 ON Pari (type_id)');
        $this->addSql('CREATE INDEX IDX_8A3BB32148A60577 ON Pari (affiche_id)');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DEE90C4AE');
        $this->addSql('DROP INDEX IDX_64BA5E7DEE90C4AE ON Pronostic');
        $this->addSql('ALTER TABLE Pronostic ADD affiche_id INT NOT NULL, DROP pari_id');
        $this->addSql('ALTER TABLE Pronostic ADD CONSTRAINT FK_64BA5E7D48A60577 FOREIGN KEY (affiche_id) REFERENCES affiche (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7D48A60577 ON Pronostic (affiche_id)');
    }
}
