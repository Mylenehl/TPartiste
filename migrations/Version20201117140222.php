<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201117140222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exposition CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE oeuvre CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE technique technique VARCHAR(255) NOT NULL, CHANGE support support VARCHAR(255) NOT NULL, CHANGE petite_image petite_image VARCHAR(255) NOT NULL, CHANGE grande_image grande_image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE oeuvreexposee DROP FOREIGN KEY oeuvreexposee_ibfk_1');
        $this->addSql('ALTER TABLE oeuvreexposee DROP FOREIGN KEY oeuvreexposee_ibfk_2');
        $this->addSql('DROP INDEX id_exposition ON oeuvreexposee');
        $this->addSql('DROP INDEX IDX_73F72B5B13C99B13 ON oeuvreexposee');
        $this->addSql('ALTER TABLE oeuvreexposee DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE oeuvreexposee DROP prix');
        $this->addSql('ALTER TABLE oeuvreexposee ADD PRIMARY KEY (id_exposition, id_oeuvre)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE exposition CHANGE nom nom VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE lieu lieu VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE adresse adresse VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE oeuvre CHANGE titre titre VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE technique technique VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE support support VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE petite_image petite_image VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE grande_image grande_image VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE oeuvreexposee DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE oeuvreexposee ADD prix INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvreexposee ADD CONSTRAINT oeuvreexposee_ibfk_1 FOREIGN KEY (id_oeuvre) REFERENCES oeuvre (id)');
        $this->addSql('ALTER TABLE oeuvreexposee ADD CONSTRAINT oeuvreexposee_ibfk_2 FOREIGN KEY (id_exposition) REFERENCES exposition (id)');
        $this->addSql('CREATE INDEX id_exposition ON oeuvreexposee (id_exposition)');
        $this->addSql('CREATE INDEX IDX_73F72B5B13C99B13 ON oeuvreexposee (id_oeuvre)');
        $this->addSql('ALTER TABLE oeuvreexposee ADD PRIMARY KEY (id_oeuvre, id_exposition)');
    }
}
