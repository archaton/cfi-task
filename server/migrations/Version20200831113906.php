<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831113906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create start tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA cfi');
        $this->addSql('CREATE TABLE cfi.users (id uuid NOT NULL, ip VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cfi.words (id uuid NOT NULL, user_id uuid NOT NULL, word VARCHAR(255) NOT NULL, count INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE cfi.users');
        $this->addSql('DROP TABLE cfi.words');
    }
}
