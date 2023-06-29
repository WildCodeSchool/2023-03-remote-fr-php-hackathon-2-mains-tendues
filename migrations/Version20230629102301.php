<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629102301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand ADD value INT NOT NULL');
        $this->addSql('ALTER TABLE model ADD value INT NOT NULL');
        $this->addSql('ALTER TABLE status ADD value INT NOT NULL');
        $this->addSql('ALTER TABLE stockage ADD value INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand DROP value');
        $this->addSql('ALTER TABLE status DROP value');
        $this->addSql('ALTER TABLE model DROP value');
        $this->addSql('ALTER TABLE stockage DROP value');
    }
}
