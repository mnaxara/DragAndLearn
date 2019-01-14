<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190114083157 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice ADD level_id INT NOT NULL, ADD number INT NOT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('CREATE INDEX IDX_E418C74D5FB14BA7 ON exercice (level_id)');
        $this->addSql('ALTER TABLE user ADD avatar VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user_has_exercices DROP save');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D5FB14BA7');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP INDEX IDX_E418C74D5FB14BA7 ON exercice');
        $this->addSql('ALTER TABLE exercice DROP level_id, DROP number');
        $this->addSql('ALTER TABLE user DROP avatar');
        $this->addSql('ALTER TABLE user_has_exercices ADD save TINYINT(1) NOT NULL');
    }
}
