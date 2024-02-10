<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231223120149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_feature (project_id INT NOT NULL, feature_id INT NOT NULL, INDEX IDX_89C97903166D1F9C (project_id), INDEX IDX_89C9790360E4B879 (feature_id), PRIMARY KEY(project_id, feature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_feature ADD CONSTRAINT FK_89C97903166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_feature ADD CONSTRAINT FK_89C9790360E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_feature DROP FOREIGN KEY FK_89C97903166D1F9C');
        $this->addSql('ALTER TABLE project_feature DROP FOREIGN KEY FK_89C9790360E4B879');
        $this->addSql('DROP TABLE project_feature');
    }
}
