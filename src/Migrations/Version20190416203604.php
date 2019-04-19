<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416203604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team_branches (id INT AUTO_INCREMENT NOT NULL, type LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_branch_lang (id INT AUTO_INCREMENT NOT NULL, team_branch_id INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, lang VARCHAR(3) DEFAULT NULL, INDEX IDX_3DDBB86BD3D2AE (team_branch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos_images (photo_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_8215397D7E9E4C8C (photo_id), UNIQUE INDEX UNIQ_8215397D3DA5256D (image_id), PRIMARY KEY(photo_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_branch_lang ADD CONSTRAINT FK_3DDBB86BD3D2AE FOREIGN KEY (team_branch_id) REFERENCES team_branches (id)');
        $this->addSql('ALTER TABLE photos_images ADD CONSTRAINT FK_8215397D7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photos (id)');
        $this->addSql('ALTER TABLE photos_images ADD CONSTRAINT FK_8215397D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE teams ADD branch_id INT NOT NULL, ADD image VARCHAR(256) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C22258DCD6CC49 FOREIGN KEY (branch_id) REFERENCES team_branches (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_96C22258DCD6CC49 ON teams (branch_id)');
        $this->addSql('ALTER TABLE events ADD image VARCHAR(256) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ecoGames ADD path LONGTEXT NOT NULL, ADD image VARCHAR(256) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE ecoGamesLang ADD eco_game_id INT DEFAULT NULL, ADD title LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE ecoGamesLang ADD CONSTRAINT FK_381961CB6EB9D81 FOREIGN KEY (eco_game_id) REFERENCES ecoGames (id)');
        $this->addSql('CREATE INDEX IDX_381961CB6EB9D81 ON ecoGamesLang (eco_game_id)');
        $this->addSql('ALTER TABLE teamsLang ADD team_id INT DEFAULT NULL, ADD name LONGTEXT NOT NULL, ADD position LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE teamsLang ADD CONSTRAINT FK_44EB1D22296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('CREATE INDEX IDX_44EB1D22296CD8AE ON teamsLang (team_id)');
        $this->addSql('ALTER TABLE photos ADD image VARCHAR(256) NOT NULL');
        $this->addSql('ALTER TABLE videosLang ADD video_id INT DEFAULT NULL, ADD title LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE videosLang ADD CONSTRAINT FK_929DB48529C1004E FOREIGN KEY (video_id) REFERENCES videos (id)');
        $this->addSql('CREATE INDEX IDX_929DB48529C1004E ON videosLang (video_id)');
        $this->addSql('ALTER TABLE videos ADD link LONGTEXT NOT NULL, ADD image VARCHAR(256) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE photosLang ADD photo_id INT DEFAULT NULL, ADD text LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE photosLang ADD CONSTRAINT FK_143B5BAD7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photos (id)');
        $this->addSql('CREATE INDEX IDX_143B5BAD7E9E4C8C ON photosLang (photo_id)');
        $this->addSql('ALTER TABLE eventsLang ADD event_id INT DEFAULT NULL, ADD title LONGTEXT DEFAULT NULL, ADD text LONGTEXT DEFAULT NULL, ADD lang VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE eventsLang ADD CONSTRAINT FK_8AC1A5F271F7E88B FOREIGN KEY (event_id) REFERENCES events (id)');
        $this->addSql('CREATE INDEX IDX_8AC1A5F271F7E88B ON eventsLang (event_id)');
        $this->addSql('ALTER TABLE featuresLang DROP FOREIGN KEY FK_C720662A3A36A4AD');
        $this->addSql('DROP INDEX IDX_C720662A3A36A4AD ON featuresLang');
        $this->addSql('ALTER TABLE featuresLang CHANGE feature_lang_id feature_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE featuresLang ADD CONSTRAINT FK_C720662A60E4B879 FOREIGN KEY (feature_id) REFERENCES features (id)');
        $this->addSql('CREATE INDEX IDX_C720662A60E4B879 ON featuresLang (feature_id)');
        $this->addSql('ALTER TABLE donations ADD amount LONGTEXT NOT NULL, ADD first_name LONGTEXT NOT NULL, ADD last_name LONGTEXT NOT NULL, ADD country LONGTEXT NOT NULL, ADD city LONGTEXT NOT NULL, ADD state LONGTEXT NOT NULL, ADD code LONGTEXT NOT NULL, ADD email LONGTEXT NOT NULL, ADD address LONGTEXT NOT NULL, ADD phone LONGTEXT NOT NULL, ADD employer LONGTEXT DEFAULT NULL, ADD type LONGTEXT NOT NULL, ADD certificate LONGTEXT NOT NULL, ADD account_type LONGTEXT DEFAULT NULL, ADD account_number LONGTEXT DEFAULT NULL, ADD account_holder LONGTEXT DEFAULT NULL, ADD expiry_month LONGTEXT DEFAULT NULL, ADD expiry_year LONGTEXT DEFAULT NULL, ADD cvv LONGTEXT DEFAULT NULL, ADD comments LONGTEXT DEFAULT NULL, ADD transaction_id LONGTEXT DEFAULT NULL, ADD transaction_code LONGTEXT DEFAULT NULL, ADD transaction_status LONGTEXT DEFAULT NULL, ADD period LONGTEXT DEFAULT NULL, ADD term LONGTEXT DEFAULT NULL, ADD start_month LONGTEXT DEFAULT NULL, ADD start_year LONGTEXT DEFAULT NULL, ADD mail_sent LONGTEXT DEFAULT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C22258DCD6CC49');
        $this->addSql('ALTER TABLE team_branch_lang DROP FOREIGN KEY FK_3DDBB86BD3D2AE');
        $this->addSql('DROP TABLE team_branches');
        $this->addSql('DROP TABLE team_branch_lang');
        $this->addSql('DROP TABLE photos_images');
        $this->addSql('ALTER TABLE donations DROP amount, DROP first_name, DROP last_name, DROP country, DROP city, DROP state, DROP code, DROP email, DROP address, DROP phone, DROP employer, DROP type, DROP certificate, DROP account_type, DROP account_number, DROP account_holder, DROP expiry_month, DROP expiry_year, DROP cvv, DROP comments, DROP transaction_id, DROP transaction_code, DROP transaction_status, DROP period, DROP term, DROP start_month, DROP start_year, DROP mail_sent, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE ecoGames DROP path, DROP image, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE ecoGamesLang DROP FOREIGN KEY FK_381961CB6EB9D81');
        $this->addSql('DROP INDEX IDX_381961CB6EB9D81 ON ecoGamesLang');
        $this->addSql('ALTER TABLE ecoGamesLang DROP eco_game_id, DROP title, DROP lang');
        $this->addSql('ALTER TABLE events DROP image, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE eventsLang DROP FOREIGN KEY FK_8AC1A5F271F7E88B');
        $this->addSql('DROP INDEX IDX_8AC1A5F271F7E88B ON eventsLang');
        $this->addSql('ALTER TABLE eventsLang DROP event_id, DROP title, DROP text, DROP lang');
        $this->addSql('ALTER TABLE featuresLang DROP FOREIGN KEY FK_C720662A60E4B879');
        $this->addSql('DROP INDEX IDX_C720662A60E4B879 ON featuresLang');
        $this->addSql('ALTER TABLE featuresLang CHANGE feature_id feature_lang_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE featuresLang ADD CONSTRAINT FK_C720662A3A36A4AD FOREIGN KEY (feature_lang_id) REFERENCES features (id)');
        $this->addSql('CREATE INDEX IDX_C720662A3A36A4AD ON featuresLang (feature_lang_id)');
        $this->addSql('ALTER TABLE photos DROP image');
        $this->addSql('ALTER TABLE photosLang DROP FOREIGN KEY FK_143B5BAD7E9E4C8C');
        $this->addSql('DROP INDEX IDX_143B5BAD7E9E4C8C ON photosLang');
        $this->addSql('ALTER TABLE photosLang DROP photo_id, DROP text, DROP lang');
        $this->addSql('DROP INDEX IDX_96C22258DCD6CC49 ON teams');
        $this->addSql('ALTER TABLE teams DROP branch_id, DROP image, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE teamsLang DROP FOREIGN KEY FK_44EB1D22296CD8AE');
        $this->addSql('DROP INDEX IDX_44EB1D22296CD8AE ON teamsLang');
        $this->addSql('ALTER TABLE teamsLang DROP team_id, DROP name, DROP position, DROP lang');
        $this->addSql('ALTER TABLE videos DROP link, DROP image, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE videosLang DROP FOREIGN KEY FK_929DB48529C1004E');
        $this->addSql('DROP INDEX IDX_929DB48529C1004E ON videosLang');
        $this->addSql('ALTER TABLE videosLang DROP video_id, DROP title, DROP lang');
    }
}
