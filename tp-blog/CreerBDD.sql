-- ------------------------------------------------
-- BASE DE DONNEES TP_BLOG
-- ------------------------------------------------
DROP DATABASE IF EXISTS tp_blog;

CREATE DATABASE tp_blog
  CHARACTER SET utf8;   

USE tp_blog;

-- ----------------------------------
-- ARTICLES
-- ----------------------------------
CREATE TABLE articles
(
  id            TINYINT(1)    UNSIGNED NOT NULL AUTO_INCREMENT, -- 255 articles possibles
  titre         VARCHAR(25)   NOT NULL,                         -- Longueur max 25 caractères
  contenu       TEXT          NOT NULL,                         -- Longueur max 65535 caractères
  date_creation DATETIME      NOT NULL,                         -- 1000-01-01 00:00:00 à 9999-12-31 23:59:59
	
  PRIMARY KEY (id)
	
)  ENGINE = InnoDB;

-- ----------------------------------
-- COMMENTAIRES
-- ----------------------------------
CREATE TABLE commentaires
(
  id                TINYINT(1)    UNSIGNED NOT NULL AUTO_INCREMENT, -- 255 commentaires possibles
  id_article        TINYINT(1)    UNSIGNED NOT NULL,                -- L'id de l'article concerné
  auteur            VARCHAR(25)   NOT NULL,                         -- 25 caractère max pour le nom de l'auteur
  commentaire       TEXT          NOT NULL,                         -- Longueur max 65535 caractères
  date_commentaire  DATETIME      NOT NULL,                         -- 1000-01-01 00:00:00 à 9999-12-31 23:59:59

  PRIMARY KEY (id),

  CONSTRAINT fk_id_article
    FOREIGN KEY (id_article)
    REFERENCES articles(id)
	
)  ENGINE = InnoDB;