<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116132605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD objets_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC6C3A2500 FOREIGN KEY (objets_id) REFERENCES objet (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC6C3A2500 ON commentaire (objets_id)');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38BA9CD190');
        $this->addSql('DROP INDEX IDX_46CD4C38BA9CD190 ON objet');
        $this->addSql('ALTER TABLE objet DROP commentaire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC6C3A2500');
        $this->addSql('DROP INDEX IDX_67F068BC6C3A2500 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP objets_id');
        $this->addSql('ALTER TABLE objet ADD commentaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_46CD4C38BA9CD190 ON objet (commentaire_id)');
    }
}
