<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031193129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, password, birth_date, postcode, status, code_erp, photo, hire_date, email, created_at, updated_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, role_id INTEGER NOT NULL, name VARCHAR(300) NOT NULL, password VARCHAR(600) NOT NULL, birth_date DATE NOT NULL, postcode VARCHAR(12) DEFAULT NULL, status VARCHAR(25) NOT NULL, code_erp VARCHAR(10) DEFAULT NULL, photo VARCHAR(300) DEFAULT NULL, hire_date DATE NOT NULL, email VARCHAR(300) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, name, password, birth_date, postcode, status, code_erp, photo, hire_date, email, created_at, updated_at) SELECT id, name, password, birth_date, postcode, status, code_erp, photo, hire_date, email, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, password, birth_date, postcode, status, code_erp, photo, hire_date, email, created_at, updated_at FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(300) NOT NULL, password VARCHAR(600) NOT NULL, birth_date DATE NOT NULL, postcode VARCHAR(12) DEFAULT NULL, status VARCHAR(25) NOT NULL, code_erp VARCHAR(10) DEFAULT NULL, photo VARCHAR(300) DEFAULT NULL, hire_date DATE NOT NULL, email VARCHAR(300) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO "user" (id, name, password, birth_date, postcode, status, code_erp, photo, hire_date, email, created_at, updated_at) SELECT id, name, password, birth_date, postcode, status, code_erp, photo, hire_date, email, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
