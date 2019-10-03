<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905094159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, username VARCHAR(60) NOT NULL, commentary CLOB NOT NULL, rate INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id), CONSTRAINT FK_33C9F81BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_33C9F81B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE review');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id))');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
    }
}
