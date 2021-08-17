<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210814142037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_49CF2272E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Affiche (id INT AUTO_INCREMENT NOT NULL, tournoi_id INT NOT NULL, favori_id INT NOT NULL, challenger_id INT NOT NULL, schedule DATETIME NOT NULL, score VARCHAR(255) NOT NULL, INDEX IDX_2B8C7691F607770A (tournoi_id), INDEX IDX_2B8C7691FF17033F (favori_id), INDEX IDX_2B8C76912D521FDF (challenger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Athlete (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, origine_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, taille DOUBLE PRECISION NOT NULL, INDEX IDX_F86BABDA6E44244 (pays_id), INDEX IDX_F86BABD87998E (origine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE City (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8D69AD0AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Formule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Pays (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, shortcut VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Sport (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Surface (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Tournoi (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, surface_id INT NOT NULL, tenant_titre_id INT DEFAULT NULL, debut DATETIME DEFAULT NULL, fin DATETIME DEFAULT NULL, date_creation DATETIME DEFAULT NULL, siteweb VARCHAR(255) DEFAULT NULL, dotation INT DEFAULT NULL, INDEX IDX_D712E0438BAC62AF (city_id), INDEX IDX_D712E043CA11F534 (surface_id), INDEX IDX_D712E043F4E9CCA9 (tenant_titre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Affiche ADD CONSTRAINT FK_2B8C7691F607770A FOREIGN KEY (tournoi_id) REFERENCES Tournoi (id)');
        $this->addSql('ALTER TABLE Affiche ADD CONSTRAINT FK_2B8C7691FF17033F FOREIGN KEY (favori_id) REFERENCES Athlete (id)');
        $this->addSql('ALTER TABLE Affiche ADD CONSTRAINT FK_2B8C76912D521FDF FOREIGN KEY (challenger_id) REFERENCES Athlete (id)');
        $this->addSql('ALTER TABLE Athlete ADD CONSTRAINT FK_F86BABDA6E44244 FOREIGN KEY (pays_id) REFERENCES Pays (id)');
        $this->addSql('ALTER TABLE Athlete ADD CONSTRAINT FK_F86BABD87998E FOREIGN KEY (origine_id) REFERENCES Pays (id)');
        $this->addSql('ALTER TABLE City ADD CONSTRAINT FK_8D69AD0AF92F3E70 FOREIGN KEY (country_id) REFERENCES Pays (id)');
        $this->addSql('ALTER TABLE Tournoi ADD CONSTRAINT FK_D712E0438BAC62AF FOREIGN KEY (city_id) REFERENCES City (id)');
        $this->addSql('ALTER TABLE Tournoi ADD CONSTRAINT FK_D712E043CA11F534 FOREIGN KEY (surface_id) REFERENCES Surface (id)');
        $this->addSql('ALTER TABLE Tournoi ADD CONSTRAINT FK_D712E043F4E9CCA9 FOREIGN KEY (tenant_titre_id) REFERENCES Athlete (id)');
        $this->addSql('ALTER TABLE user ADD isVerified TINYINT(1) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD birth_date DATETIME DEFAULT NULL, ADD profession VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Affiche DROP FOREIGN KEY FK_2B8C7691FF17033F');
        $this->addSql('ALTER TABLE Affiche DROP FOREIGN KEY FK_2B8C76912D521FDF');
        $this->addSql('ALTER TABLE Tournoi DROP FOREIGN KEY FK_D712E043F4E9CCA9');
        $this->addSql('ALTER TABLE Tournoi DROP FOREIGN KEY FK_D712E0438BAC62AF');
        $this->addSql('ALTER TABLE Athlete DROP FOREIGN KEY FK_F86BABDA6E44244');
        $this->addSql('ALTER TABLE Athlete DROP FOREIGN KEY FK_F86BABD87998E');
        $this->addSql('ALTER TABLE City DROP FOREIGN KEY FK_8D69AD0AF92F3E70');
        $this->addSql('ALTER TABLE Tournoi DROP FOREIGN KEY FK_D712E043CA11F534');
        $this->addSql('ALTER TABLE Affiche DROP FOREIGN KEY FK_2B8C7691F607770A');
        $this->addSql('DROP TABLE Admin');
        $this->addSql('DROP TABLE Affiche');
        $this->addSql('DROP TABLE Athlete');
        $this->addSql('DROP TABLE City');
        $this->addSql('DROP TABLE Formule');
        $this->addSql('DROP TABLE Pays');
        $this->addSql('DROP TABLE Sport');
        $this->addSql('DROP TABLE Surface');
        $this->addSql('DROP TABLE Tournoi');
        $this->addSql('ALTER TABLE User DROP isVerified, DROP nom, DROP prenom, DROP birth_date, DROP profession');
    }
}
