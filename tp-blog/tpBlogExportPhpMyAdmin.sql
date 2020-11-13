-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 13 nov. 2020 à 23:18
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tp_blog`
--
CREATE DATABASE IF NOT EXISTS `tp_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tp_blog`;

-- --------------------------------------------------------

--
-- Structure de la table `acces_admin`
--

DROP TABLE IF EXISTS `acces_admin`;
CREATE TABLE IF NOT EXISTS `acces_admin` (
  `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(25) NOT NULL,
  `mdp_admin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acces_admin`
--

INSERT INTO `acces_admin` (`id`, `id_admin`, `mdp_admin`) VALUES
(1, 'id', '$2y$10$FgrMVzBf4sMjXJQdUg3xD.5sh5Wrqv43ZGFPH5Zl/KgNnrjTQxycC');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date_creation`) VALUES
(2, 'Premier article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In fringilla, nisl ut varius sagittis, quam lectus tristique leo, vitae rutrum nisi risus a est. Aliquam accumsan consectetur tincidunt. Maecenas pharetra justo non purus bibendum volutpat. Vivamus auctor dapibus nisi sed faucibus. Mauris feugiat sem sed varius mollis. Vestibulum porta lacus at rutrum finibus. Donec venenatis egestas nulla quis posuere. Phasellus sodales massa a magna viverra interdum. Vivamus sed eleifend dui, sed congue odio. Etiam venenatis auctor justo ac mollis.\r\n', '2020-11-13 23:47:02'),
(3, 'DeuxiÃ¨me article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In fringilla, nisl ut varius sagittis, quam lectus tristique leo, vitae rutrum nisi risus a est. Aliquam accumsan consectetur tincidunt. Maecenas pharetra justo non purus bibendum volutpat. Vivamus auctor dapibus nisi sed faucibus. Mauris feugiat sem sed varius mollis. Vestibulum porta lacus at rutrum finibus. Donec venenatis egestas nulla quis posuere. Phasellus sodales massa a magna viverra interdum. Vivamus sed eleifend dui, sed congue odio. Etiam venenatis auctor justo ac mollis.\r\n\r\n', '2020-11-14 00:02:15'),
(4, 'TroisiÃ¨me article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In fringilla, nisl ut varius sagittis, quam lectus tristique leo, vitae rutrum nisi risus a est. Aliquam accumsan consectetur tincidunt. Maecenas pharetra justo non purus bibendum volutpat. Vivamus auctor dapibus nisi sed faucibus. Mauris feugiat sem sed varius mollis. Vestibulum porta lacus at rutrum finibus. Donec venenatis egestas nulla quis posuere. Phasellus sodales massa a magna viverra interdum. Vivamus sed eleifend dui, sed congue odio. Etiam venenatis auctor justo ac mollis.', '2020-11-14 00:02:27'),
(5, 'QuatriÃ¨me article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In fringilla, nisl ut varius sagittis, quam lectus tristique leo, vitae rutrum nisi risus a est. Aliquam accumsan consectetur tincidunt. Maecenas pharetra justo non purus bibendum volutpat. Vivamus auctor dapibus nisi sed faucibus. Mauris feugiat sem sed varius mollis. Vestibulum porta lacus at rutrum finibus. Donec venenatis egestas nulla quis posuere. Phasellus sodales massa a magna viverra interdum. Vivamus sed eleifend dui, sed congue odio. Etiam venenatis auctor justo ac mollis.', '2020-11-14 00:02:38'),
(6, 'CinquiÃ¨me article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In fringilla, nisl ut varius sagittis, quam lectus tristique leo, vitae rutrum nisi risus a est. Aliquam accumsan consectetur tincidunt. Maecenas pharetra justo non purus bibendum volutpat. Vivamus auctor dapibus nisi sed faucibus. Mauris feugiat sem sed varius mollis. Vestibulum porta lacus at rutrum finibus. Donec venenatis egestas nulla quis posuere. Phasellus sodales massa a magna viverra interdum. Vivamus sed eleifend dui, sed congue odio. Etiam venenatis auctor justo ac mollis.', '2020-11-14 00:02:47'),
(7, 'SixiÃ¨me article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In fringilla, nisl ut varius sagittis, quam lectus tristique leo, vitae rutrum nisi risus a est. Aliquam accumsan consectetur tincidunt. Maecenas pharetra justo non purus bibendum volutpat. Vivamus auctor dapibus nisi sed faucibus. Mauris feugiat sem sed varius mollis. Vestibulum porta lacus at rutrum finibus. Donec venenatis egestas nulla quis posuere. Phasellus sodales massa a magna viverra interdum. Vivamus sed eleifend dui, sed congue odio. Etiam venenatis auctor justo ac mollis.', '2020-11-14 00:02:58');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_article` tinyint(1) UNSIGNED NOT NULL,
  `auteur` varchar(25) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_article`, `auteur`, `commentaire`, `date_commentaire`) VALUES
(1, 2, 'Christophe', 'Les commentaires sont rÃ©-initialisÃ©s', '2020-11-13 22:47:12'),
(2, 2, 'Antoine', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.\r\n', '2020-11-13 23:06:38'),
(3, 7, 'ZaÃ¯d', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:07:00'),
(4, 7, 'Etienne', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:07:09'),
(5, 6, 'Riad', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:07:29'),
(6, 6, 'Tatiana', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:07:41'),
(7, 5, 'YaÃ«l', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:07:59'),
(8, 5, 'Ulrich', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:08:09'),
(9, 3, 'Ilona', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:08:29'),
(10, 3, 'Olivier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices felis lorem, a consectetur nulla ornare iaculis. Quisque eget tristique purus, nec laoreet mauris. In ut massa enim. Integer a finibus neque, ut interdum libero.', '2020-11-13 23:08:37');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_id_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
