<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260428132011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, name, importance FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, importance INTEGER NOT NULL)');
        $this->addSql('INSERT INTO priority (id, name, importance) SELECT id, name, importance FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62A6DC275E237E06 ON priority (name)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, title, is_pinned, status_enum FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, is_pinned BOOLEAN NOT NULL, status_enum VARCHAR(255) NOT NULL, priority_id INTEGER DEFAULT NULL, CONSTRAINT FK_527EDB25497B19F9 FOREIGN KEY (priority_id) REFERENCES priority (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO task (id, title, is_pinned, status_enum) SELECT id, title, is_pinned, status_enum FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB252B36786B ON task (title)');
        $this->addSql('CREATE INDEX IDX_527EDB25497B19F9 ON task (priority_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__priority AS SELECT id, name, importance FROM priority');
        $this->addSql('DROP TABLE priority');
        $this->addSql('CREATE TABLE priority (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, importance INTEGER NOT NULL)');
        $this->addSql('INSERT INTO priority (id, name, importance) SELECT id, name, importance FROM __temp__priority');
        $this->addSql('DROP TABLE __temp__priority');
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, title, is_pinned, status_enum FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, is_pinned BOOLEAN NOT NULL, status_enum VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO task (id, title, is_pinned, status_enum) SELECT id, title, is_pinned, status_enum FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB252B36786B ON task (title)');
    }
}
