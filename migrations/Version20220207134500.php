<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207134500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE options (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, theme_id INT NOT NULL, nbenfants INT NOT NULL, date DATE NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_4DA23959027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations_options (reservations_id INT NOT NULL, options_id INT NOT NULL, INDEX IDX_5D0D8859D9A7F869 (reservations_id), INDEX IDX_5D0D88593ADB05F1 (options_id), PRIMARY KEY(reservations_id, options_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations_users (reservations_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_DE575306D9A7F869 (reservations_id), INDEX IDX_DE57530667B3B43D (users_id), PRIMARY KEY(reservations_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE themes (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, descriptif LONGTEXT NOT NULL, duree INT NOT NULL, prix DOUBLE PRECISION NOT NULL, age_min INT NOT NULL, age_max INT NOT NULL, nbenfant_min INT NOT NULL, nbenfant_max INT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, identifiant VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(14) DEFAULT NULL, mail VARCHAR(255) NOT NULL, interet TINYINT(1) NOT NULL, admin_right TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E95126AC48 (mail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23959027487 FOREIGN KEY (theme_id) REFERENCES themes (id)');
        $this->addSql('ALTER TABLE reservations_options ADD CONSTRAINT FK_5D0D8859D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_options ADD CONSTRAINT FK_5D0D88593ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_users ADD CONSTRAINT FK_DE575306D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_users ADD CONSTRAINT FK_DE57530667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations_options DROP FOREIGN KEY FK_5D0D88593ADB05F1');
        $this->addSql('ALTER TABLE reservations_options DROP FOREIGN KEY FK_5D0D8859D9A7F869');
        $this->addSql('ALTER TABLE reservations_users DROP FOREIGN KEY FK_DE575306D9A7F869');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23959027487');
        $this->addSql('ALTER TABLE reservations_users DROP FOREIGN KEY FK_DE57530667B3B43D');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reservations_options');
        $this->addSql('DROP TABLE reservations_users');
        $this->addSql('DROP TABLE themes');
        $this->addSql('DROP TABLE users');
    }
}
