<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501093034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, post_id INT NOT NULL, author_id INT NOT NULL, text VARCHAR(500) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE TABLE micro_post (id INT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, text TEXT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AEFE017F675F31B ON micro_post (author_id)');
        $this->addSql('CREATE TABLE micro_post_user (micro_post_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(micro_post_id, user_id))');
        $this->addSql('CREATE INDEX IDX_19DCF74D11E37CEA ON micro_post_user (micro_post_id)');
        $this->addSql('CREATE INDEX IDX_19DCF74DA76ED395 ON micro_post_user (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE user_profile (id INT NOT NULL, user_rel_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, bio VARCHAR(1024) DEFAULT NULL, website_url VARCHAR(255) DEFAULT NULL, twitter_username VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB4052B58BAF0 ON user_profile (user_rel_id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES micro_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE micro_post ADD CONSTRAINT FK_2AEFE017F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE micro_post_user ADD CONSTRAINT FK_19DCF74D11E37CEA FOREIGN KEY (micro_post_id) REFERENCES micro_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE micro_post_user ADD CONSTRAINT FK_19DCF74DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB4052B58BAF0 FOREIGN KEY (user_rel_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE micro_post DROP CONSTRAINT FK_2AEFE017F675F31B');
        $this->addSql('ALTER TABLE micro_post_user DROP CONSTRAINT FK_19DCF74D11E37CEA');
        $this->addSql('ALTER TABLE micro_post_user DROP CONSTRAINT FK_19DCF74DA76ED395');
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT FK_D95AB4052B58BAF0');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE micro_post');
        $this->addSql('DROP TABLE micro_post_user');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_profile');
    }
}
