<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328085006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations_users DROP FOREIGN KEY FK_DE57530667B3B43D');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, interest TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE reservations_options');
        $this->addSql('DROP TABLE reservations_users');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE options ADD slug VARCHAR(255) NOT NULL, CHANGE descriptif descriptif LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE themes ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations_options (reservations_id INT NOT NULL, options_id INT NOT NULL, INDEX IDX_5D0D88593ADB05F1 (options_id), INDEX IDX_5D0D8859D9A7F869 (reservations_id), PRIMARY KEY(reservations_id, options_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservations_users (reservations_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_DE57530667B3B43D (users_id), INDEX IDX_DE575306D9A7F869 (reservations_id), PRIMARY KEY(reservations_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, motdepasse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, identifiant VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(14) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, interet TINYINT(1) NOT NULL, `admin` TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E95126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservations_options ADD CONSTRAINT FK_5D0D88593ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_options ADD CONSTRAINT FK_5D0D8859D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_users ADD CONSTRAINT FK_DE57530667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_users ADD CONSTRAINT FK_DE575306D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE options DROP slug, CHANGE descriptif descriptif LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE themes DROP slug');
    }
}
