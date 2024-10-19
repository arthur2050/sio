<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017192727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, discount NUMERIC(10, 2) NOT NULL, type VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_64BF3F0277153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, tax_number VARCHAR(20) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, payment_processor VARCHAR(50) NOT NULL, payment_successful TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, product_id INT NOT NULL, coupon_id INT DEFAULT NULL, INDEX IDX_E52FFDEE4584665A (product_id), INDEX IDX_E52FFDEE66C5951B (coupon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('CREATE TABLE tax_rate (id INT AUTO_INCREMENT NOT NULL, country_code VARCHAR(2) NOT NULL, rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE66C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE4584665A');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE66C5951B');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE tax_rate');
    }
}
