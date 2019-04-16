<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416011424 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE feature_page (feature_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_4620395360E4B879 (feature_id), INDEX IDX_46203953C4663E4 (page_id), PRIMARY KEY(feature_id, page_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feature_page ADD CONSTRAINT FK_4620395360E4B879 FOREIGN KEY (feature_id) REFERENCES features (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feature_page ADD CONSTRAINT FK_46203953C4663E4 FOREIGN KEY (page_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE features ADD link LONGTEXT DEFAULT NULL, ADD link_type VARCHAR(255) NOT NULL, ADD position VARCHAR(255) NOT NULL, ADD `order` VARCHAR(255) NOT NULL, ADD image VARCHAR(256) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE featuresLang ADD feature_lang_id INT DEFAULT NULL, ADD title LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE featuresLang ADD CONSTRAINT FK_C720662A3A36A4AD FOREIGN KEY (feature_lang_id) REFERENCES features (id)');
        $this->addSql('CREATE INDEX IDX_C720662A3A36A4AD ON featuresLang (feature_lang_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE feature_page');
        $this->addSql('ALTER TABLE features DROP link, DROP link_type, DROP position, DROP `order`, DROP image, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE featuresLang DROP FOREIGN KEY FK_C720662A3A36A4AD');
        $this->addSql('DROP INDEX IDX_C720662A3A36A4AD ON featuresLang');
        $this->addSql('ALTER TABLE featuresLang DROP feature_lang_id, DROP title, DROP lang');
    }
}
