<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628205813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE smartphone (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, model_id INT DEFAULT NULL, ram_id INT DEFAULT NULL, stockage_id INT DEFAULT NULL, status_id INT DEFAULT NULL, price INT NOT NULL, is_sold TINYINT(1) DEFAULT NULL, INDEX IDX_26B07E2E44F5D008 (brand_id), INDEX IDX_26B07E2E7975B7E7 (model_id), INDEX IDX_26B07E2E3366068 (ram_id), INDEX IDX_26B07E2EDAA83D7F (stockage_id), INDEX IDX_26B07E2E6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E3366068 FOREIGN KEY (ram_id) REFERENCES ram (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2EDAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E44F5D008');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E7975B7E7');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E3366068');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2EDAA83D7F');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E6BF700BD');
        $this->addSql('DROP TABLE smartphone');
    }
}
