<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523191557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT DEFAULT NULL, CHANGE synopsis synopsis LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE season CHANGE program_id program_id INT DEFAULT NULL, CHANGE number number INT DEFAULT NULL, CHANGE year year INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT NOT NULL, CHANGE synopsis synopsis LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE season CHANGE program_id program_id INT NOT NULL, CHANGE number number INT NOT NULL, CHANGE year year INT NOT NULL');
    }
}
