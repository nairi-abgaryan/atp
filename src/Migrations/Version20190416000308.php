<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416000308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ambassadorsLang ADD ambassador_id INT DEFAULT NULL, ADD text_bottom LONGTEXT NOT NULL, ADD title LONGTEXT DEFAULT NULL, ADD text_top LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE ambassadorsLang ADD CONSTRAINT FK_9A77E2BA4A709FDF FOREIGN KEY (ambassador_id) REFERENCES ambassadors (id)');
        $this->addSql('CREATE INDEX IDX_9A77E2BA4A709FDF ON ambassadorsLang (ambassador_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE page');
        $this->addSql('ALTER TABLE ambassadorsLang DROP FOREIGN KEY FK_9A77E2BA4A709FDF');
        $this->addSql('DROP INDEX IDX_9A77E2BA4A709FDF ON ambassadorsLang');
        $this->addSql('ALTER TABLE ambassadorsLang DROP ambassador_id, DROP text_bottom, DROP title, DROP text_top, DROP lang');
    }
}
