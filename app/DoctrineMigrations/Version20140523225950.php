<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140523225950 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE addon_category (addon_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_E7F0EE15CC642678 (addon_id), INDEX IDX_E7F0EE1512469DE2 (category_id), PRIMARY KEY(addon_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE addon_category ADD CONSTRAINT FK_E7F0EE15CC642678 FOREIGN KEY (addon_id) REFERENCES addons (id)");
        $this->addSql("ALTER TABLE addon_category ADD CONSTRAINT FK_E7F0EE1512469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)");
        $this->addSql("ALTER TABLE addon_categories DROP FOREIGN KEY FK_FC7EC07012469DE2");
        $this->addSql("ALTER TABLE addon_categories DROP FOREIGN KEY FK_FC7EC070CC642678");
        $this->addSql("DROP INDEX IDX_FC7EC070CC642678 ON addon_categories");
        $this->addSql("DROP INDEX IDX_FC7EC07012469DE2 ON addon_categories");
        $this->addSql("ALTER TABLE addon_categories DROP PRIMARY KEY");
        $this->addSql("ALTER TABLE addon_categories ADD PRIMARY KEY (category_id, addon_id)");
        $this->addSql("ALTER TABLE categories ADD title VARCHAR(100) NOT NULL, CHANGE parent_id parent_id INT NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE addon_category");
        $this->addSql("ALTER TABLE addon_categories DROP PRIMARY KEY");
        $this->addSql("ALTER TABLE addon_categories ADD CONSTRAINT FK_FC7EC07012469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)");
        $this->addSql("ALTER TABLE addon_categories ADD CONSTRAINT FK_FC7EC070CC642678 FOREIGN KEY (addon_id) REFERENCES addons (id)");
        $this->addSql("CREATE INDEX IDX_FC7EC070CC642678 ON addon_categories (addon_id)");
        $this->addSql("CREATE INDEX IDX_FC7EC07012469DE2 ON addon_categories (category_id)");
        $this->addSql("ALTER TABLE addon_categories ADD PRIMARY KEY (addon_id, category_id)");
        $this->addSql("ALTER TABLE categories DROP title, CHANGE parent_id parent_id INT DEFAULT NULL");
    }
}
