<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122122910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE objet_caracteristique (objet_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_C9C9776CF520CF5A (objet_id), INDEX IDX_C9C9776C1704EEB7 (caracteristique_id), PRIMARY KEY(objet_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet_caracteristique ADD CONSTRAINT FK_C9C9776CF520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_caracteristique ADD CONSTRAINT FK_C9C9776C1704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet_caracteristique DROP FOREIGN KEY FK_C9C9776CF520CF5A');
        $this->addSql('ALTER TABLE objet_caracteristique DROP FOREIGN KEY FK_C9C9776C1704EEB7');
        $this->addSql('DROP TABLE objet_caracteristique');
    }
}
