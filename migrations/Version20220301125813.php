<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301125813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations_users DROP FOREIGN KEY FK_DE575306D9A7F869');
        $this->addSql('ALTER TABLE reservations_users ADD CONSTRAINT FK_DE575306D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE users CHANGE admin_right admin TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations_users DROP FOREIGN KEY FK_DE575306D9A7F869');
        $this->addSql('ALTER TABLE reservations_users ADD CONSTRAINT FK_DE575306D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users CHANGE admin admin_right TINYINT(1) NOT NULL');
    }
}
