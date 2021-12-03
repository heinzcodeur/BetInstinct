<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016140434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game CHANGE resultat resultat ENUM(\'en attente\',\'gagnant\',\'perdant\')');
        $this->addSql('ALTER TABLE jeu CHANGE resultat resultat ENUM(\'en attente\',\'perdant\',\'gagnant\')');
        $this->addSql('ALTER TABLE transaction CHANGE type type ENUM(\'gain\',\'perte\',\'deposit\',\'retrait\')');
        $this->addSql('ALTER TABLE type2choix ADD choix26 VARCHAR(255) DEFAULT NULL, ADD choix27 VARCHAR(255) DEFAULT NULL, ADD choix28 VARCHAR(255) DEFAULT NULL, ADD choix29 VARCHAR(255) DEFAULT NULL, ADD choix30 VARCHAR(255) DEFAULT NULL, ADD choix31 VARCHAR(255) DEFAULT NULL, ADD choix32 VARCHAR(255) DEFAULT NULL, ADD choix33 VARCHAR(255) DEFAULT NULL, ADD choix34 VARCHAR(255) DEFAULT NULL, ADD choix35 VARCHAR(255) DEFAULT NULL, ADD choix36 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Game CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Jeu CHANGE resultat resultat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Transaction CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE Type2choix DROP choix26, DROP choix27, DROP choix28, DROP choix29, DROP choix30, DROP choix31, DROP choix32, DROP choix33, DROP choix34, DROP choix35, DROP choix36');
    }
}
