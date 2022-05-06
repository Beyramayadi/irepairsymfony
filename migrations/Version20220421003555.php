<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220421003555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE nom_categorie nom_categorie VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE compte CHANGE Nom Nom VARCHAR(20) NOT NULL, CHANGE Prenom Prenom VARCHAR(20) NOT NULL, CHANGE Email Email VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE devis CHANGE Id_Client Id_Client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture CHANGE id_piece id_piece INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel CHANGE type_piece type_piece VARCHAR(30) NOT NULL, CHANGE probleme probleme TEXT NOT NULL, CHANGE Id_Client Id_Client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pole CHANGE nom_pole nom_pole VARCHAR(30) NOT NULL, CHANGE lieu_pole lieu_pole VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE Reclamation Reclamation TEXT NOT NULL, CHANGE id_Client id_Client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rendezvous CHANGE id_devis id_devis INT DEFAULT NULL, CHANGE Id_Client Id_Client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE id_categorie id_categorie INT DEFAULT NULL, CHANGE type_service type_service VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE stock ADD updated_at DATETIME NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, CHANGE id_pole id_pole INT DEFAULT NULL, CHANGE quantite_article quantite_article VARCHAR(30) NOT NULL, CHANGE prix_article prix_article VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE nom_categorie nom_categorie VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE compte CHANGE Nom Nom VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE Prenom Prenom VARCHAR(20) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE Email Email VARCHAR(40) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE devis CHANGE Id_Client Id_Client INT NOT NULL');
        $this->addSql('ALTER TABLE facture CHANGE id_piece id_piece INT NOT NULL');
        $this->addSql('ALTER TABLE materiel CHANGE type_piece type_piece VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE probleme probleme TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE Id_Client Id_Client INT NOT NULL');
        $this->addSql('ALTER TABLE pole CHANGE nom_pole nom_pole VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE lieu_pole lieu_pole VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE reclamation CHANGE Reclamation Reclamation TEXT CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE id_Client id_Client INT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous CHANGE id_devis id_devis INT NOT NULL, CHANGE Id_Client Id_Client INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE id_categorie id_categorie INT NOT NULL, CHANGE type_service type_service VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE stock DROP updated_at, DROP image_name, CHANGE id_pole id_pole INT NOT NULL, CHANGE quantite_article quantite_article INT NOT NULL, CHANGE prix_article prix_article DOUBLE PRECISION NOT NULL');
    }
}
