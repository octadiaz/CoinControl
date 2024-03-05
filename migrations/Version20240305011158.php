<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305011158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_transaccion (categoria_id INT NOT NULL, transaccion_id INT NOT NULL, INDEX IDX_A0BE26683397707A (categoria_id), INDEX IDX_A0BE26688DB9694F (transaccion_id), PRIMARY KEY(categoria_id, transaccion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, dni INT NOT NULL, UNIQUE INDEX UNIQ_F41C9B25F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaccion (id INT AUTO_INCREMENT NOT NULL, cliente_transaccion_id INT DEFAULT NULL, monto BIGINT NOT NULL, fecha DATETIME NOT NULL, nombre VARCHAR(255) NOT NULL, comentario VARCHAR(255) NOT NULL, INDEX IDX_BFF96AF7294D96FC (cliente_transaccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria_transaccion ADD CONSTRAINT FK_A0BE26683397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categoria_transaccion ADD CONSTRAINT FK_A0BE26688DB9694F FOREIGN KEY (transaccion_id) REFERENCES transaccion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaccion ADD CONSTRAINT FK_BFF96AF7294D96FC FOREIGN KEY (cliente_transaccion_id) REFERENCES cliente (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categoria_transaccion DROP FOREIGN KEY FK_A0BE26683397707A');
        $this->addSql('ALTER TABLE categoria_transaccion DROP FOREIGN KEY FK_A0BE26688DB9694F');
        $this->addSql('ALTER TABLE transaccion DROP FOREIGN KEY FK_BFF96AF7294D96FC');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE categoria_transaccion');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE transaccion');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
