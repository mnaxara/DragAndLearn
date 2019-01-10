<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110165035 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, theme_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, email VARCHAR(80) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D64959027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64959027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE exercice_user ADD CONSTRAINT FK_B368283589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_user ADD CONSTRAINT FK_B3682835A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trophy_user ADD CONSTRAINT FK_7AAA1519F59AEEEF FOREIGN KEY (trophy_id) REFERENCES trophy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trophy_user ADD CONSTRAINT FK_7AAA1519A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exercice_user DROP FOREIGN KEY FK_B3682835A76ED395');
        $this->addSql('ALTER TABLE trophy_user DROP FOREIGN KEY FK_7AAA1519A76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE exercice_user DROP FOREIGN KEY FK_B368283589D40298');
        $this->addSql('ALTER TABLE trophy_user DROP FOREIGN KEY FK_7AAA1519F59AEEEF');
    }
}
