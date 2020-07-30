<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200502135821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coments ADD user_id INT NOT NULL, ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE coments ADD CONSTRAINT FK_73DCFA1AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE coments ADD CONSTRAINT FK_73DCFA1A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_73DCFA1AA76ED395 ON coments (user_id)');
        $this->addSql('CREATE INDEX IDX_73DCFA1A4584665A ON coments (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coments DROP FOREIGN KEY FK_73DCFA1AA76ED395');
        $this->addSql('ALTER TABLE coments DROP FOREIGN KEY FK_73DCFA1A4584665A');
        $this->addSql('DROP INDEX IDX_73DCFA1AA76ED395 ON coments');
        $this->addSql('DROP INDEX IDX_73DCFA1A4584665A ON coments');
        $this->addSql('ALTER TABLE coments DROP user_id, DROP product_id');
    }
}
