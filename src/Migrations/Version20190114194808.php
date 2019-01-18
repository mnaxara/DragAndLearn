<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190114194808 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, libelle VARCHAR(20) NOT NULL, help LONGTEXT DEFAULT NULL, solution VARCHAR(50) DEFAULT NULL, slug VARCHAR(128) NOT NULL, number INT NOT NULL, instruction LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_E418C74D989D9B62 (slug), INDEX IDX_E418C74D5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, color VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trophy (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, icone VARCHAR(50) NOT NULL, hidden TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trophy_user (trophy_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7AAA1519F59AEEEF (trophy_id), INDEX IDX_7AAA1519A76ED395 (user_id), PRIMARY KEY(trophy_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, email VARCHAR(80) NOT NULL, avatar VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D64959027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_exercices (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, exercices_id INT NOT NULL, time TIME NOT NULL, finish TINYINT(1) DEFAULT NULL, value VARCHAR(5) NOT NULL, INDEX IDX_DCACD5FE67B3B43D (users_id), INDEX IDX_DCACD5FE192C7251 (exercices_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE trophy_user ADD CONSTRAINT FK_7AAA1519F59AEEEF FOREIGN KEY (trophy_id) REFERENCES trophy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trophy_user ADD CONSTRAINT FK_7AAA1519A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64959027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE user_has_exercices ADD CONSTRAINT FK_DCACD5FE67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_exercices ADD CONSTRAINT FK_DCACD5FE192C7251 FOREIGN KEY (exercices_id) REFERENCES exercice (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_has_exercices DROP FOREIGN KEY FK_DCACD5FE192C7251');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D5FB14BA7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64959027487');
        $this->addSql('ALTER TABLE trophy_user DROP FOREIGN KEY FK_7AAA1519F59AEEEF');
        $this->addSql('ALTER TABLE trophy_user DROP FOREIGN KEY FK_7AAA1519A76ED395');
        $this->addSql('ALTER TABLE user_has_exercices DROP FOREIGN KEY FK_DCACD5FE67B3B43D');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE trophy');
        $this->addSql('DROP TABLE trophy_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_exercices');
    }
}
