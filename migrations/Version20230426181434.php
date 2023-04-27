<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426181434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart2_product (cart2_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_94B1CC489F1DF9AD (cart2_id), INDEX IDX_94B1CC484584665A (product_id), PRIMARY KEY(cart2_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart2_product ADD CONSTRAINT FK_94B1CC489F1DF9AD FOREIGN KEY (cart2_id) REFERENCES cart2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart2_product ADD CONSTRAINT FK_94B1CC484584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart2 DROP products');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart2_product DROP FOREIGN KEY FK_94B1CC489F1DF9AD');
        $this->addSql('ALTER TABLE cart2_product DROP FOREIGN KEY FK_94B1CC484584665A');
        $this->addSql('DROP TABLE cart2_product');
        $this->addSql('ALTER TABLE cart2 ADD products LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
