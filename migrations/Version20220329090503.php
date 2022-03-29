<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329090503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, repas_id INT NOT NULL, date VARCHAR(10) NOT NULL, commentary VARCHAR(255) DEFAULT NULL, INDEX IDX_8F91ABF067B3B43D (users_id), INDEX IDX_8F91ABF01D236AAA (repas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis_types_categories (id INT AUTO_INCREMENT NOT NULL, avis_id INT NOT NULL, types_categories_id INT NOT NULL, note INT NOT NULL, INDEX IDX_F83D5EB197E709F (avis_id), INDEX IDX_F83D5EB96B1EA77 (types_categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qrcode_pin (id INT AUTO_INCREMENT NOT NULL, pin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qrcode_token (id INT AUTO_INCREMENT NOT NULL, token VARCHAR(150) NOT NULL, date VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_categories (id INT AUTO_INCREMENT NOT NULL, shortname VARCHAR(50) NOT NULL, longname VARCHAR(255) NOT NULL, statut TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_repas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF067B3B43D FOREIGN KEY (users_id) REFERENCES types_users (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF01D236AAA FOREIGN KEY (repas_id) REFERENCES types_repas (id)');
        $this->addSql('ALTER TABLE avis_types_categories ADD CONSTRAINT FK_F83D5EB197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE avis_types_categories ADD CONSTRAINT FK_F83D5EB96B1EA77 FOREIGN KEY (types_categories_id) REFERENCES types_categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_types_categories DROP FOREIGN KEY FK_F83D5EB197E709F');
        $this->addSql('ALTER TABLE avis_types_categories DROP FOREIGN KEY FK_F83D5EB96B1EA77');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF01D236AAA');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF067B3B43D');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE avis_types_categories');
        $this->addSql('DROP TABLE qrcode_pin');
        $this->addSql('DROP TABLE qrcode_token');
        $this->addSql('DROP TABLE types_categories');
        $this->addSql('DROP TABLE types_repas');
        $this->addSql('DROP TABLE types_users');
        $this->addSql('DROP TABLE user');
    }
}
