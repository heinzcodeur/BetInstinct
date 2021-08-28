<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210827234717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Les2joueursWin1set (id INT AUTO_INCREMENT NOT NULL, oui TINYINT(1) NOT NULL, non TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nombre2sets (id INT AUTO_INCREMENT NOT NULL, affiche_id INT DEFAULT NULL, nb2set DOUBLE PRECISION DEFAULT NULL, nb3set DOUBLE PRECISION DEFAULT NULL, nb4set DOUBLE PRECISION DEFAULT NULL, nb5set DOUBLE PRECISION DEFAULT NULL, INDEX IDX_3BCDBCDA48A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nombre2sets ADD CONSTRAINT FK_3BCDBCDA48A60577 FOREIGN KEY (affiche_id) REFERENCES Affiche (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Les2joueursWin1set');
        $this->addSql('DROP TABLE nombre2sets');
    }
}
