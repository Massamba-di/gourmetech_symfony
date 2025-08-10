<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250808231910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE temps_de_preparations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recettes ADD temps_de_preparations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recettes ADD CONSTRAINT FK_EB48E72C227E0A1F FOREIGN KEY (temps_de_preparations_id) REFERENCES temps_de_preparations (id)');
        $this->addSql('CREATE INDEX IDX_EB48E72C227E0A1F ON recettes (temps_de_preparations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recettes DROP FOREIGN KEY FK_EB48E72C227E0A1F');
        $this->addSql('DROP TABLE temps_de_preparations');
        $this->addSql('DROP INDEX IDX_EB48E72C227E0A1F ON recettes');
        $this->addSql('ALTER TABLE recettes DROP temps_de_preparations_id');
    }
}
