<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210827225949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vainqueur DROP INDEX UNIQ_EDDCE6D248A60577, ADD INDEX IDX_EDDCE6D248A60577 (affiche_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Vainqueur DROP INDEX IDX_EDDCE6D248A60577, ADD UNIQUE INDEX UNIQ_EDDCE6D248A60577 (affiche_id)');
    }
}
