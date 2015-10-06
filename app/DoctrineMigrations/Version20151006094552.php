<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151006094552 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campo CHANGE categoriaIdCategoria categoriaIdCategoria INT DEFAULT NULL');
        $this->addSql('ALTER TABLE campodocumento CHANGE documentoIddocumento documentoIddocumento INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categoriadocumento CHANGE categoriaIdCategoria categoriaIdCategoria INT DEFAULT NULL, CHANGE documentoIddocumento documentoIddocumento INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categoriagruppo CHANGE categoriaIdCategoria categoriaIdCategoria INT DEFAULT NULL, CHANGE gruppoUtenteIdGruppo gruppoUtenteIdGruppo INT DEFAULT NULL');
        $this->addSql('ALTER TABLE richiesta CHANGE categoriaIdCategoria categoriaIdCategoria INT DEFAULT NULL, CHANGE aziendaIdazienda aziendaIdazienda INT DEFAULT NULL');
        $this->addSql('ALTER TABLE richiestadocumento CHANGE RichiestaIdRichiesta RichiestaIdRichiesta INT DEFAULT NULL, CHANGE documentoIddocumento documentoIddocumento INT DEFAULT NULL');
        $this->addSql('ALTER TABLE richiestautente CHANGE RichiestaIdRichiesta RichiestaIdRichiesta INT DEFAULT NULL, CHANGE UtenteIdUtente UtenteIdUtente INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utente CHANGE aziendaIdazienda aziendaIdazienda INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utentegruppoutente CHANGE gruppoUtenteIdGruppo gruppoUtenteIdGruppo INT DEFAULT NULL, CHANGE UtenteIdUtente UtenteIdUtente INT DEFAULT NULL');
        $this->addSql('ALTER TABLE valorizzazionecampodocumento CHANGE campodocumentoIdcampodocumento campodocumentoIdcampodocumento INT DEFAULT NULL, CHANGE richiestaDocumentoIdRichiestadocumento richiestaDocumentoIdRichiestadocumento INT DEFAULT NULL');
        $this->addSql('ALTER TABLE valorizzazionecamporichiesta CHANGE RichiestaIdRichiesta RichiestaIdRichiesta INT DEFAULT NULL, CHANGE campoIdCampo campoIdCampo INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campo CHANGE categoriaIdCategoria categoriaIdCategoria INT NOT NULL');
        $this->addSql('ALTER TABLE campodocumento CHANGE documentoIddocumento documentoIddocumento INT NOT NULL');
        $this->addSql('ALTER TABLE categoriadocumento CHANGE documentoIddocumento documentoIddocumento INT NOT NULL, CHANGE categoriaIdCategoria categoriaIdCategoria INT NOT NULL');
        $this->addSql('ALTER TABLE categoriagruppo CHANGE gruppoUtenteIdGruppo gruppoUtenteIdGruppo INT NOT NULL, CHANGE categoriaIdCategoria categoriaIdCategoria INT NOT NULL');
        $this->addSql('ALTER TABLE richiesta CHANGE aziendaIdazienda aziendaIdazienda INT NOT NULL, CHANGE categoriaIdCategoria categoriaIdCategoria INT NOT NULL');
        $this->addSql('ALTER TABLE richiestadocumento CHANGE documentoIddocumento documentoIddocumento INT NOT NULL, CHANGE RichiestaIdRichiesta RichiestaIdRichiesta INT NOT NULL');
        $this->addSql('ALTER TABLE richiestautente CHANGE UtenteIdUtente UtenteIdUtente INT NOT NULL, CHANGE RichiestaIdRichiesta RichiestaIdRichiesta INT NOT NULL');
        $this->addSql('ALTER TABLE utente CHANGE aziendaIdazienda aziendaIdazienda INT NOT NULL');
        $this->addSql('ALTER TABLE utentegruppoutente CHANGE UtenteIdUtente UtenteIdUtente INT NOT NULL, CHANGE gruppoUtenteIdGruppo gruppoUtenteIdGruppo INT NOT NULL');
        $this->addSql('ALTER TABLE valorizzazionecampodocumento CHANGE richiestaDocumentoIdRichiestadocumento richiestaDocumentoIdRichiestadocumento INT NOT NULL, CHANGE campodocumentoIdcampodocumento campodocumentoIdcampodocumento INT NOT NULL');
        $this->addSql('ALTER TABLE valorizzazionecamporichiesta CHANGE campoIdCampo campoIdCampo INT NOT NULL, CHANGE RichiestaIdRichiesta RichiestaIdRichiesta INT NOT NULL');
    }
}
