<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220305134454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_categories (id INT AUTO_INCREMENT NOT NULL, avis_id INT NOT NULL, libelle VARCHAR(50) NOT NULL, INDEX IDX_D636E151197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_categories (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_categories ADD CONSTRAINT FK_D636E151197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE avis_categories');
        $this->addSql('DROP TABLE types_categories');
        $this->addSql('ALTER TABLE avis CHANGE date date VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE utilisateur utilisateur VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE heure heure VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE commentaire commentaire VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE qrcode_token CHANGE date date VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE token token VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE types_repas CHANGE type type VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE types_utilisateurs CHANGE type type VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
