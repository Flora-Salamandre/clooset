<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918155540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id VARCHAR(180) NOT NULL, color1_id VARCHAR(20) NOT NULL, color2_id VARCHAR(20) DEFAULT NULL, category_id VARCHAR(50) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, price NUMERIC(7, 2) NOT NULL, picture VARCHAR(255) NOT NULL, brand VARCHAR(50) DEFAULT NULL, INDEX IDX_23A0E66A76ED395 (user_id), INDEX IDX_23A0E666D1DB08F (color1_id), INDEX IDX_23A0E667FA81F61 (color2_id), INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (label VARCHAR(50) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(label)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (label VARCHAR(20) NOT NULL, code VARCHAR(7) NOT NULL, PRIMARY KEY(label)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav (user_id VARCHAR(180) NOT NULL, article_id INT NOT NULL, INDEX IDX_769BE06FA76ED395 (user_id), INDEX IDX_769BE06F7294869C (article_id), PRIMARY KEY(user_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(username)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (username)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666D1DB08F FOREIGN KEY (color1_id) REFERENCES color (label)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E667FA81F61 FOREIGN KEY (color2_id) REFERENCES color (label)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (label)');
        $this->addSql('ALTER TABLE fav ADD CONSTRAINT FK_769BE06FA76ED395 FOREIGN KEY (user_id) REFERENCES user (username)');
        $this->addSql('ALTER TABLE fav ADD CONSTRAINT FK_769BE06F7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fav DROP FOREIGN KEY FK_769BE06F7294869C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666D1DB08F');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E667FA81F61');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE fav DROP FOREIGN KEY FK_769BE06FA76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE fav');
        $this->addSql('DROP TABLE user');
    }
}
