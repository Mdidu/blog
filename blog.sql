-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 27 fév. 2020 à 18:59
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `contend` longtext NOT NULL,
  `date` int(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `contend`, `date`, `user_id`) VALUES
(1, 'First', 'First', 1582207626, 1),
(2, 'tt', 'tt update', 1582214321, 1),
(3, 'new', 'new article', 1582306865, 2),
(4, 'aa update', 'Un test', 1582360650, 1),
(5, 'Un vrai article', '11lkjhgfghjkl fghjkjhgfdfg hjpkjhgf ghlkhgf oiugf fghjk ^plokiuy fgh p oiuytf yui oit ghj kk jht fgh k khgf guhio p mlkhg hjk  mh bgn,lùml fjhh.\r\n\r\nlkjhgfghjkl fghjkjhgfdfg hjpkjhgf ghlkhgf oiugf fghjk ^plokiuy fgh p oiuytf yui oit ghj kk jht fgh k khgf guhio p mlkhg hjk  mh bgn,lùml fjhh\r\nlkjhgfghjkl fghjkjhgfdfg hjpkjhgf ghlkhgf oiugf fghjk ^plokiuy fgh p oiuytf yui oit ghj kk jht fgh k khgf guhio p mlkhg hjk  mh bgn,lùml fjhh', 1582814190, 1),
(7, 'test', 'test', 1582822699, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

DROP TABLE IF EXISTS `commentary`;
CREATE TABLE IF NOT EXISTS `commentary` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contend` longtext NOT NULL,
  `date` int(20) NOT NULL,
  `articles_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articles_id` (`articles_id`),
  KEY `fk_user_id_commentary` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentary`
--

INSERT INTO `commentary` (`id`, `contend`, `date`, `articles_id`, `user_id`) VALUES
(1, 'First', 1582207637, 1, 2),
(2, 'test', 1582207831, 1, 2),
(3, 'test', 1582306494, 2, 1),
(4, 'bof', 1582306854, 1, 1),
(5, 'test add comment', 1582366725, 3, 2),
(6, 'Un commentaire pour le nouveau insert', 1582381824, 4, 1),
(7, 'bof bof', 1582815423, 5, 1),
(8, 'second add', 1582821520, 3, 1),
(12, 'aa', 1582828292, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rank` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `rank`) VALUES
(1, 'Users'),
(2, 'Moderator'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `group_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `group_id`) VALUES
(1, 'Mdidu', '$2y$10$aPD/M2Be311RS3.xOPXO0.AjMtopgPcSeg3xvl.4FtIkxvd7NDnCC', 3),
(2, 'goulum', '$2y$10$4FxCSDY.3b/XTQiTEA4ygu.RI7fZZLZ16Qf3EXdoc7Uf3pQQAiYHW', 1),
(3, 'luffy', '$2y$10$tX8zbuFTHAAXXe22LQIRrOG.LmLMmk7/LAzcw0E6hhpbdr1mZq2RO', 1),
(4, 'goku', '$2y$10$pcGpr7PJgWs5RSsT91ZNHubtIhBYGeQoPlD8bjhhaR1D6gi14lLa6', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `fk_articles_id` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_commentary` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_group_id` FOREIGN KEY (`group_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
