<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031143243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calculated_hours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER NOT NULL, date DATE NOT NULL, worked_hours TIME NOT NULL, hours_balance TIME NOT NULL, CONSTRAINT FK_31B97DA89D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_31B97DA89D86650F ON calculated_hours (user_id_id)');
        $this->addSql('CREATE TABLE departament (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE holiday (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, every_year SMALLINT NOT NULL, holiday_bridge BOOLEAN NOT NULL, half_day_friday BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE permission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE role_permission (role_id INTEGER NOT NULL, permission_id INTEGER NOT NULL, PRIMARY KEY(role_id, permission_id), CONSTRAINT FK_6F7DF886D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6F7DF886FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6F7DF886D60322AC ON role_permission (role_id)');
        $this->addSql('CREATE INDEX IDX_6F7DF886FED90CCA ON role_permission (permission_id)');
        $this->addSql('CREATE TABLE schedule (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, daily_schedule TIME NOT NULL, weekly_work_schedule INTEGER NOT NULL, description VARCHAR(255) NOT NULL, overtime_approved TIME NOT NULL, lateness_tolerance TIME NOT NULL)');
        $this->addSql('CREATE TABLE time_record (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER NOT NULL, date DATE NOT NULL, register TIME NOT NULL, type VARCHAR(255) NOT NULL, CONSTRAINT FK_C2C2D0679D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C2C2D0679D86650F ON time_record (user_id_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(300) NOT NULL, password VARCHAR(600) NOT NULL, birth_date DATE NOT NULL, postcode VARCHAR(12) DEFAULT NULL, status VARCHAR(25) NOT NULL, code_erp VARCHAR(10) DEFAULT NULL, photo VARCHAR(300) DEFAULT NULL, hire_date DATE NOT NULL, email VARCHAR(300) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE TABLE vacation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username_id INTEGER NOT NULL, initial_date DATE NOT NULL, final_date DATE NOT NULL, CONSTRAINT FK_E3DADF75ED766068 FOREIGN KEY (username_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E3DADF75ED766068 ON vacation (username_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE calculated_hours');
        $this->addSql('DROP TABLE departament');
        $this->addSql('DROP TABLE holiday');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_permission');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE time_record');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE vacation');
    }
}
