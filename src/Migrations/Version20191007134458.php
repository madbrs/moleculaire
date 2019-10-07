<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007134458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id), CONSTRAINT FK_33C9F81BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_33C9F81B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('DROP INDEX IDX_794381C659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, recipe_id, username, commentary, rate FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, username VARCHAR(60) NOT NULL COLLATE BINARY, commentary CLOB NOT NULL COLLATE BINARY, rate INTEGER NOT NULL, CONSTRAINT FK_794381C659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO review (id, recipe_id, username, commentary, rate) SELECT id, recipe_id, username, commentary, rate FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
        $this->addSql('DROP INDEX IDX_1EFEF66759D8A214');
        $this->addSql('DROP INDEX IDX_1EFEF667E0704780');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cooking_tools_recipe AS SELECT cooking_tools_id, recipe_id FROM cooking_tools_recipe');
        $this->addSql('DROP TABLE cooking_tools_recipe');
        $this->addSql('CREATE TABLE cooking_tools_recipe (cooking_tools_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(cooking_tools_id, recipe_id), CONSTRAINT FK_1EFEF667E0704780 FOREIGN KEY (cooking_tools_id) REFERENCES cooking_tools (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1EFEF66759D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cooking_tools_recipe (cooking_tools_id, recipe_id) SELECT cooking_tools_id, recipe_id FROM __temp__cooking_tools_recipe');
        $this->addSql('DROP TABLE __temp__cooking_tools_recipe');
        $this->addSql('CREATE INDEX IDX_1EFEF66759D8A214 ON cooking_tools_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_1EFEF667E0704780 ON cooking_tools_recipe (cooking_tools_id)');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, unit_id, name, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, quantity INTEGER NOT NULL, CONSTRAINT FK_6BAF7870F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient (id, unit_id, name, quantity) SELECT id, unit_id, name, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('DROP INDEX IDX_36F27176933FE08C');
        $this->addSql('DROP INDEX IDX_36F2717659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient_recipe AS SELECT ingredient_id, recipe_id FROM ingredient_recipe');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('CREATE TABLE ingredient_recipe (ingredient_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, recipe_id), CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_36F2717659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient_recipe (ingredient_id, recipe_id) SELECT ingredient_id, recipe_id FROM __temp__ingredient_recipe');
        $this->addSql('DROP TABLE __temp__ingredient_recipe');
        $this->addSql('CREATE INDEX IDX_36F27176933FE08C ON ingredient_recipe (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_36F2717659D8A214 ON ingredient_recipe (recipe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE step');
        $this->addSql('DROP INDEX IDX_1EFEF667E0704780');
        $this->addSql('DROP INDEX IDX_1EFEF66759D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cooking_tools_recipe AS SELECT cooking_tools_id, recipe_id FROM cooking_tools_recipe');
        $this->addSql('DROP TABLE cooking_tools_recipe');
        $this->addSql('CREATE TABLE cooking_tools_recipe (cooking_tools_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(cooking_tools_id, recipe_id))');
        $this->addSql('INSERT INTO cooking_tools_recipe (cooking_tools_id, recipe_id) SELECT cooking_tools_id, recipe_id FROM __temp__cooking_tools_recipe');
        $this->addSql('DROP TABLE __temp__cooking_tools_recipe');
        $this->addSql('CREATE INDEX IDX_1EFEF667E0704780 ON cooking_tools_recipe (cooking_tools_id)');
        $this->addSql('CREATE INDEX IDX_1EFEF66759D8A214 ON cooking_tools_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, unit_id, name, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ingredient (id, unit_id, name, quantity) SELECT id, unit_id, name, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('DROP INDEX IDX_36F27176933FE08C');
        $this->addSql('DROP INDEX IDX_36F2717659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient_recipe AS SELECT ingredient_id, recipe_id FROM ingredient_recipe');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('CREATE TABLE ingredient_recipe (ingredient_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(ingredient_id, recipe_id))');
        $this->addSql('INSERT INTO ingredient_recipe (ingredient_id, recipe_id) SELECT ingredient_id, recipe_id FROM __temp__ingredient_recipe');
        $this->addSql('DROP TABLE __temp__ingredient_recipe');
        $this->addSql('CREATE INDEX IDX_36F27176933FE08C ON ingredient_recipe (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_36F2717659D8A214 ON ingredient_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_794381C659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, recipe_id, username, commentary, rate FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, username VARCHAR(60) NOT NULL, commentary CLOB NOT NULL, rate INTEGER NOT NULL)');
        $this->addSql('INSERT INTO review (id, recipe_id, username, commentary, rate) SELECT id, recipe_id, username, commentary, rate FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
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
