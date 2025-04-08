<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408083836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE soigneur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, speciality VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pingouin ADD soigneur_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pingouin ADD CONSTRAINT FK_E1FA53E7ECF1F665 FOREIGN KEY (soigneur_id) REFERENCES soigneur (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E1FA53E7ECF1F665 ON pingouin (soigneur_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE pingouin DROP FOREIGN KEY FK_E1FA53E7ECF1F665
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE soigneur
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E1FA53E7ECF1F665 ON pingouin
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pingouin DROP soigneur_id
        SQL);
    }
}
