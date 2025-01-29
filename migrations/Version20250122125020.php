<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122125020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE objet_special (objet_id INT NOT NULL, special_id INT NOT NULL, INDEX IDX_976529D8F520CF5A (objet_id), INDEX IDX_976529D84F5B3969 (special_id), PRIMARY KEY(objet_id, special_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE special (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE objet_special ADD CONSTRAINT FK_976529D8F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet_special ADD CONSTRAINT FK_976529D84F5B3969 FOREIGN KEY (special_id) REFERENCES special (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objet_special DROP FOREIGN KEY FK_976529D8F520CF5A');
        $this->addSql('ALTER TABLE objet_special DROP FOREIGN KEY FK_976529D84F5B3969');
        $this->addSql('DROP TABLE objet_special');
        $this->addSql('DROP TABLE special');
    }
}
