<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607082946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD first_name VARCHAR(255) NOT NULL, ADD given_name VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD number INT NOT NULL, ADD brand VARCHAR(255) NOT NULL, ADD website VARCHAR(255) NOT NULL, ADD social_media VARCHAR(255) NOT NULL, ADD collection_description LONGTEXT NOT NULL, ADD desired_dates INT NOT NULL, ADD concept LONGTEXT NOT NULL, ADD outfit_count INT NOT NULL, ADD technical_requirements LONGTEXT NOT NULL, ADD budget INT NOT NULL, ADD additional_information LONGTEXT NOT NULL, ADD consent TINYINT(1) NOT NULL, DROP subject, DROP message');
        $this->addSql('ALTER TABLE user CHANGE role_id role_id INT NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE role_id role_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE contact ADD subject LONGTEXT NOT NULL, ADD message LONGTEXT NOT NULL, DROP first_name, DROP given_name, DROP address, DROP number, DROP brand, DROP website, DROP social_media, DROP collection_description, DROP desired_dates, DROP concept, DROP outfit_count, DROP technical_requirements, DROP budget, DROP additional_information, DROP consent');
    }
}
