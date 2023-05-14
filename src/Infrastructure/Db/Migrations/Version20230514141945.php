<?php

declare(strict_types=1);

namespace App\Infrastructure\Db\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230514141945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Contact (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, type TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_83DFDFA4217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Contact ADD CONSTRAINT FK_83DFDFA4217BBB47 FOREIGN KEY (person_id) REFERENCES Person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Contact DROP FOREIGN KEY FK_83DFDFA4217BBB47');
        $this->addSql('DROP TABLE Contact');
        $this->addSql('DROP TABLE Person');
    }
}
