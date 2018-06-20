CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE vcategoriadirittiutente (idutente INT NOT NULL, idcategoria INT NOT NULL, nomearea VARCHAR(255) DEFAULT NULL, descrizionearea VARCHAR(255) DEFAULT NULL, nomecategoria VARCHAR(255) DEFAULT NULL, descrizionecategoria VARCHAR(255) DEFAULT NULL, isabilitatoinserimento INT DEFAULT NULL, isvalidatoretecnico INT DEFAULT NULL, isvalidatoreamministrativo INT DEFAULT NULL, PRIMARY KEY(idutente, idcategoria)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE area CHANGE id id INT AUTO_INCREMENT NOT NULL;
ALTER TABLE campo CHANGE descrizione descrizione VARCHAR(100) DEFAULT NULL;
ALTER TABLE migration_versions CHANGE version version VARCHAR(255) NOT NULL;
ALTER TABLE richiesta CHANGE urgenza urgenza TINYINT(1) NOT NULL;
ALTER TABLE utente CHANGE idFosUser idFosUser INT DEFAULT NULL;