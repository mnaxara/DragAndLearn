<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110170906 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_has_exercices (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, exercices_id INT NOT NULL, time TIME NOT NULL, save TINYINT(1) NOT NULL, INDEX IDX_DCACD5FE67B3B43D (users_id), INDEX IDX_DCACD5FE192C7251 (exercices_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_has_exercices ADD CONSTRAINT FK_DCACD5FE67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_exercices ADD CONSTRAINT FK_DCACD5FE192C7251 FOREIGN KEY (exercices_id) REFERENCES exercice (id)');
        $this->addSql('DROP TABLE exercice_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exercice_user (exercice_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B3682835A76ED395 (user_id), INDEX IDX_B368283589D40298 (exercice_id), PRIMARY KEY(exercice_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exercice_user ADD CONSTRAINT FK_B368283589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_user ADD CONSTRAINT FK_B3682835A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_has_exercices');
    }
}
