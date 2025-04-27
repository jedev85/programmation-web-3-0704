<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410122740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE repas (id INT AUTO_INCREMENT NOT NULL, pingouin_id INT NOT NULL, quantite INT NOT NULL, type LONGTEXT NOT NULL COMMENT '(DC2Type:simple_array)', is_eat TINYINT(1) NOT NULL, date DATETIME NOT NULL, INDEX IDX_A8D351B36121661 (pingouin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE repas ADD CONSTRAINT FK_A8D351B36121661 FOREIGN KEY (pingouin_id) REFERENCES pingouin (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B36121661
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE repas
        SQL);
    }
}
