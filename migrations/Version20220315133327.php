<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315133327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_types_categories (id INT AUTO_INCREMENT NOT NULL, avis_id INT NOT NULL, types_categories_id INT NOT NULL, note INT NOT NULL, INDEX IDX_F83D5EB197E709F (avis_id), INDEX IDX_F83D5EB96B1EA77 (types_categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_categories (id INT AUTO_INCREMENT NOT NULL, shortname VARCHAR(50) NOT NULL, longname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_types_categories ADD CONSTRAINT FK_F83D5EB197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('ALTER TABLE avis_types_categories ADD CONSTRAINT FK_F83D5EB96B1EA77 FOREIGN KEY (types_categories_id) REFERENCES types_categories (id)');
        $this->addSql('DROP TABLE types_utilisateurs');
        $this->addSql('ALTER TABLE avis ADD users_id INT NOT NULL, ADD repas_id INT NOT NULL, DROP utilisateur, DROP heure, CHANGE commentaire commentary VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF067B3B43D FOREIGN KEY (users_id) REFERENCES types_users (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF01D236AAA FOREIGN KEY (repas_id) REFERENCES types_repas (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF067B3B43D ON avis (users_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF01D236AAA ON avis (repas_id)');
        $this->addSql('ALTER TABLE qrcode_pin CHANGE pin pin VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE qrcode_token DROP date, CHANGE token token VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE types_repas ADD name VARCHAR(255) NOT NULL, DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_types_categories DROP FOREIGN KEY FK_F83D5EB96B1EA77');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF067B3B43D');
        $this->addSql('CREATE TABLE types_utilisateurs (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE avis_types_categories');
        $this->addSql('DROP TABLE types_categories');
        $this->addSql('DROP TABLE types_users');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF01D236AAA');
        $this->addSql('DROP INDEX IDX_8F91ABF067B3B43D ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF01D236AAA ON avis');
        $this->addSql('ALTER TABLE avis ADD utilisateur VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD heure VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD commentaire VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP users_id, DROP repas_id, DROP commentary, CHANGE date date VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE qrcode_pin CHANGE pin pin INT NOT NULL');
        $this->addSql('ALTER TABLE qrcode_token ADD date VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE token token VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE types_repas ADD type VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP name');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
