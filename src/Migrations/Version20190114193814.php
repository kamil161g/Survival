<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190114193814 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status_mission ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE status_mission ADD CONSTRAINT FK_98B785B9A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_98B785B9A76ED395 ON status_mission (user_id)');
        $this->addSql('ALTER TABLE users DROP status_mission');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status_mission DROP FOREIGN KEY FK_98B785B9A76ED395');
        $this->addSql('DROP INDEX IDX_98B785B9A76ED395 ON status_mission');
        $this->addSql('ALTER TABLE status_mission DROP user_id');
        $this->addSql('ALTER TABLE users ADD status_mission TINYINT(1) NOT NULL');
    }
}
