<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908143817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD created_by_id INT DEFAULT NULL, ADD last_updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FE562D849 FOREIGN KEY (last_updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FB03A8386 ON company (created_by_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094FE562D849 ON company (last_updated_by_id)');
        $this->addSql('ALTER TABLE user ADD created_by_id INT DEFAULT NULL, ADD last_updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E562D849 FOREIGN KEY (last_updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B03A8386 ON user (created_by_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E562D849 ON user (last_updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B03A8386');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E562D849');
        $this->addSql('DROP INDEX IDX_8D93D649B03A8386 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649E562D849 ON user');
        $this->addSql('ALTER TABLE user DROP created_by_id, DROP last_updated_by_id');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB03A8386');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FE562D849');
        $this->addSql('DROP INDEX IDX_4FBF094FB03A8386 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094FE562D849 ON company');
        $this->addSql('ALTER TABLE company DROP created_by_id, DROP last_updated_by_id');
    }
}
