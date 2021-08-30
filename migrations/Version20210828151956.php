<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828151956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bet ADD cote1 DOUBLE PRECISION DEFAULT NULL, ADD cote2 DOUBLE PRECISION DEFAULT NULL, ADD cote3 DOUBLE PRECISION DEFAULT NULL, ADD cote4 DOUBLE PRECISION DEFAULT NULL, ADD cote5 DOUBLE PRECISION DEFAULT NULL, ADD cote6 DOUBLE PRECISION DEFAULT NULL, ADD cote7 DOUBLE PRECISION DEFAULT NULL, ADD cote8 DOUBLE PRECISION DEFAULT NULL, ADD cote9 DOUBLE PRECISION DEFAULT NULL, ADD cote10 DOUBLE PRECISION DEFAULT NULL, ADD cote11 DOUBLE PRECISION DEFAULT NULL, ADD cote12 DOUBLE PRECISION DEFAULT NULL, ADD cote13 DOUBLE PRECISION DEFAULT NULL, ADD cote14 DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Bet DROP cote1, DROP cote2, DROP cote3, DROP cote4, DROP cote5, DROP cote6, DROP cote7, DROP cote8, DROP cote9, DROP cote10, DROP cote11, DROP cote12, DROP cote13, DROP cote14');
    }
}
