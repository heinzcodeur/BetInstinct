<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210830155133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pronostic DROP FOREIGN KEY FK_64BA5E7DEE90C4AE');
        $this->addSql('DROP INDEX IDX_64BA5E7DEE90C4AE ON pronostic');
        $this->addSql('ALTER TABLE pronostic ADD affiche_id INT NOT NULL, ADD bet_id INT NOT NULL, ADD choix VARCHAR(255) DEFAULT NULL, ADD cote DOUBLE PRECISION DEFAULT NULL, DROP pari_id');
        $this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7D48A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
        $this->addSql('ALTER TABLE pronostic ADD CONSTRAINT FK_64BA5E7DD871DC26 FOREIGN KEY (bet_id) REFERENCES Bet (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7D48A60577 ON pronostic (affiche_id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DD871DC26 ON pronostic (bet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7D48A60577');
        $this->addSql('ALTER TABLE Pronostic DROP FOREIGN KEY FK_64BA5E7DD871DC26');
        $this->addSql('DROP INDEX IDX_64BA5E7D48A60577 ON Pronostic');
        $this->addSql('DROP INDEX IDX_64BA5E7DD871DC26 ON Pronostic');
        $this->addSql('ALTER TABLE Pronostic ADD pari_id INT DEFAULT NULL, DROP affiche_id, DROP bet_id, DROP choix, DROP cote');
        $this->addSql('ALTER TABLE Pronostic ADD CONSTRAINT FK_64BA5E7DEE90C4AE FOREIGN KEY (pari_id) REFERENCES pari (id)');
        $this->addSql('CREATE INDEX IDX_64BA5E7DEE90C4AE ON Pronostic (pari_id)');
    }
}
