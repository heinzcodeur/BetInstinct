<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828122620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bet DROP FOREIGN KEY FK_C3BDAA7BC54C8C93');
        $this->addSql('DROP INDEX IDX_C3BDAA7BC54C8C93 ON bet');
        $this->addSql('ALTER TABLE bet CHANGE type_id TypedePari_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_C3BDAA7B938D61FC FOREIGN KEY (TypedePari_id) REFERENCES TypedePari (id)');
        $this->addSql('CREATE INDEX IDX_C3BDAA7B938D61FC ON bet (TypedePari_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Bet DROP FOREIGN KEY FK_C3BDAA7B938D61FC');
        $this->addSql('DROP INDEX IDX_C3BDAA7B938D61FC ON Bet');
        $this->addSql('ALTER TABLE Bet CHANGE typedepari_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Bet ADD CONSTRAINT FK_C3BDAA7BC54C8C93 FOREIGN KEY (type_id) REFERENCES type2pari (id)');
        $this->addSql('CREATE INDEX IDX_C3BDAA7BC54C8C93 ON Bet (type_id)');
    }
}
