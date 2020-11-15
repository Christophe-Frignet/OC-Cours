-- ------------------------------------------------
-- BASE DE DONNEES TP_BLOG
-- ------------------------------------------------
DROP DATABASE IF EXISTS tp_blog;  -- on efface la bdd si elle existe déjà

CREATE DATABASE tp_blog           -- on crée la bdd
  CHARACTER SET utf8;             -- on défini le jeu de caractères qui sera utilisé

USE tp_blog;                      -- on sélectionne la bdd sur laquelle on va travailler

-- ----------------------------------
-- ARTICLES
-- ----------------------------------
CREATE TABLE articles
(
  id            TINYINT(1)    UNSIGNED NOT NULL AUTO_INCREMENT,   -- 255 articles possibles
  titre         VARCHAR(50)   NOT NULL,                           -- longueur max 50 caractères
  contenu       TEXT          NOT NULL,                           -- longueur max 65535 caractères
  date_creation DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP, -- de 1000-01-01 00:00:00 à 9999-12-31 23:59:59
	
  PRIMARY KEY (id) 
	
)  ENGINE = InnoDB;

-- ----------------------------------
-- COMMENTAIRES
-- ----------------------------------
CREATE TABLE commentaires
(
  id                TINYINT(1)    UNSIGNED NOT NULL AUTO_INCREMENT, -- 255 commentaires possibles
  id_article        TINYINT(1)    UNSIGNED NOT NULL,                -- id de l'article concerné
  auteur            VARCHAR(25)   NOT NULL,                         -- 25 caractère max pour le nom de l'auteur
  commentaire       TEXT          NOT NULL,                         -- longueur max 65535 caractères
  date_commentaire  DATETIME      NOT NULL,                         -- de 1000-01-01 00:00:00 à 9999-12-31 23:59:59

  PRIMARY KEY (id),

  CONSTRAINT fk_id_article
    FOREIGN KEY (id_article)
    REFERENCES articles(id)
	
)  ENGINE = InnoDB;

-- ----------------------------------
--  ACCES ADMIN
-- ----------------------------------
CREATE TABLE acces_admin
(
  id                TINYINT(1)    UNSIGNED NOT NULL AUTO_INCREMENT, -- 255 accès possibles
  id_admin          VARCHAR(25)   NOT NULL,                         -- 25 caractères max pour l'identifiant
  mdp_admin         VARCHAR(255)  NOT NULL,                         -- 255 caractères max pour pass hashé

  PRIMARY KEY (id)

)  ENGINE = InnoDB;