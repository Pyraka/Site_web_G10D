-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 15 avr. 2020 à 13:07
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `infinite_`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `adminPassword` text NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `deletefaq`
--

DROP TABLE IF EXISTS `deletefaq`;
CREATE TABLE IF NOT EXISTS `deletefaq` (
  `idDelete` int(11) NOT NULL AUTO_INCREMENT,
  `idQuestion` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idDelete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `idQuestion` int(11) NOT NULL AUTO_INCREMENT,
  `textQuestion` text NOT NULL,
  `textAnswer` text NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`idQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idQuestion`, `textQuestion`, `textAnswer`, `isDeleted`) VALUES
(1, 'premiere question', 'premiere rep', 1),
(2, 'deuxieme question', 'deuxieme rep', 1),
(3, '3 ee', 'dadazda', 0),
(4, 'dazdadad', 'afgzgzg', 0),
(5, 'premiere entrée', 'deuxieme entrée', 0),
(6, 'testquestion', 'testanswer', 0);

-- --------------------------------------------------------

--
-- Structure de la table `forum_comments`
--

DROP TABLE IF EXISTS `forum_comments`;
CREATE TABLE IF NOT EXISTS `forum_comments` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idTopic` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`idComment`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_comments`
--

INSERT INTO `forum_comments` (`idComment`, `idTopic`, `idUser`, `date`, `text`) VALUES
(1, 1, 5, '2020-04-09 00:10:00', 'text premier'),
(2, 1, 6, '2020-04-10 01:00:00', 'je suis d\'accord'),
(3, 2, 5, '2020-04-12 00:00:00', 'gz\"gqzG'),
(4, 4, 5, '2020-04-14 19:31:04', 'aa'),
(5, 4, 5, '2020-04-14 19:31:23', 'aa'),
(6, 4, 5, '2020-04-14 19:32:45', 'zaz'),
(7, 4, 5, '2020-04-14 19:33:04', 'eazer'),
(8, 4, 5, '2020-04-14 19:33:48', 'eazer'),
(9, 4, 5, '2020-04-14 19:38:59', 'aaza'),
(10, 4, 5, '2020-04-14 19:39:07', 'nouveau message'),
(11, 4, 5, '2020-04-14 19:41:31', 'éé'),
(12, 4, 5, '2020-04-14 19:42:24', '&lt;script&gt;alert(&quot;ok&quot;)&lt;/script&gt;'),
(13, 6, 5, '2020-04-14 20:28:57', 'message');

-- --------------------------------------------------------

--
-- Structure de la table `forum_topic`
--

DROP TABLE IF EXISTS `forum_topic`;
CREATE TABLE IF NOT EXISTS `forum_topic` (
  `idTopic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  `isClosed` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTopic`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_topic`
--

INSERT INTO `forum_topic` (`idTopic`, `title`, `content`, `date`, `idUser`, `isClosed`) VALUES
(1, 'titre topic 1', 'contenu question', '2020-04-01 00:00:00', 5, 0),
(2, 'titre questio 2', 'ceci est la quesiton 2', '2020-04-02 00:00:00', 6, 0),
(3, 'ques 3', 'texte quest 3', '2020-04-03 00:00:00', 5, 1),
(4, 'titre', 'contenu', '2020-04-14 18:18:06', 5, 0),
(5, '&lt;script&gt;alert(&quot;ok&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;ok&quot;)&lt;/script&gt;', '2020-04-14 19:42:40', 5, 0),
(6, 'nouveau sujet', 'texte', '2020-04-14 20:28:39', 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `idManager` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `productKey` varchar(255) NOT NULL,
  `managerPassword` text NOT NULL,
  PRIMARY KEY (`idManager`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messaging`
--

DROP TABLE IF EXISTS `messaging`;
CREATE TABLE IF NOT EXISTS `messaging` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `textMessage` text NOT NULL,
  `date` datetime NOT NULL,
  `idWritter` int(11) NOT NULL,
  `idReceiver` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messaging`
--

INSERT INTO `messaging` (`idMessage`, `textMessage`, `date`, `idWritter`, `idReceiver`) VALUES
(1, 'texte du messgae', '2020-04-09 18:50:04', 5, 6),
(2, 'text 2 message', '2020-04-02 04:27:00', 6, 5),
(3, 'aa', '2020-04-01 00:00:00', 5, 5),
(5, 'aaa', '2020-04-06 00:00:00', 5, 6),
(6, 'aa', '2020-04-05 00:00:00', 5, 7),
(10, 'test', '2020-04-10 16:22:04', 5, 6),
(11, 'message envoye depuis la messagerie', '2020-04-10 16:22:54', 5, 6),
(12, 'aaa', '2020-04-10 18:14:19', 5, 6),
(13, 'aa', '2020-04-10 18:18:00', 5, 6),
(14, 'est ce que ca marche', '2020-04-10 18:18:08', 5, 6),
(15, 'nouveau', '2020-04-10 18:22:38', 5, 6),
(16, 'test', '2020-04-10 18:22:41', 5, 6),
(17, 'encore', '2020-04-10 18:22:45', 5, 6),
(18, 'et encore!', '2020-04-10 18:22:49', 5, 6),
(19, 'message', '2020-04-10 19:05:10', 5, 6),
(20, 'mess', '2020-04-10 19:05:19', 5, 6),
(21, 'aa', '2020-04-10 19:39:30', 5, 6),
(22, 'aa', '2020-04-10 21:50:33', 6, 5),
(23, 'gbiugiug', '2020-04-10 21:51:45', 6, 5),
(24, 'noinonb', '2020-04-10 21:51:53', 6, 6),
(25, 'message', '2020-04-11 01:16:23', 6, 5),
(26, 'aa', '2020-04-11 01:17:51', 5, 6),
(27, 'ceic', '2020-04-11 01:18:23', 5, 6),
(28, 'aaa', '2020-04-11 01:28:16', 5, 7),
(29, 'aa', '2020-04-11 01:38:23', 5, 6),
(36, 'faerf ', '2020-04-11 02:05:15', 5, 7),
(38, 'aaa', '2020-04-11 02:29:14', 6, 5),
(39, 'aaa', '2020-04-11 02:31:23', 6, 5),
(40, 'message de 5 a 7', '2020-04-11 14:11:14', 5, 7),
(41, 'message de 6 à 5', '2020-04-11 14:17:29', 6, 5),
(42, 'dadazdaz', '2020-04-11 16:23:48', 5, 6),
(43, 'dernier message de 5 a 7', '2020-04-11 16:24:08', 5, 7),
(44, 'dernier message de 5 à 6', '2020-04-11 16:24:27', 5, 6),
(46, 'àà', '2020-04-11 17:10:50', 5, 6),
(47, 'asasàasa', '2020-04-11 17:11:14', 5, 6),
(48, 'sasa  ad', '2020-04-11 17:12:08', 5, 6),
(49, 'test', '2020-04-11 17:13:08', 6, 5),
(50, 'test2', '2020-04-11 17:16:31', 5, 6),
(51, 'aaa', '2020-04-11 17:17:37', 5, 7),
(53, '&d&', '2020-04-11 17:30:42', 5, 6),
(54, 'd\"dd', '2020-04-11 17:30:49', 5, 7),
(55, 'premier message', '2020-04-11 17:32:47', 5, 10),
(56, 'deuxieme message', '2020-04-11 17:33:20', 10, 5),
(57, 'encore', '2020-04-11 17:33:52', 10, 5),
(58, 'edada', '2020-04-11 17:33:57', 10, 5),
(59, 'adafg', '2020-04-12 00:20:57', 5, 5),
(60, 'dzada', '2020-04-12 00:21:00', 5, 5),
(61, 'salut!', '2020-04-12 16:00:46', 14, 5),
(62, 'salut zaeaz', '2020-04-12 16:00:59', 14, 12),
(64, 'assa', '2020-04-14 19:54:03', 5, 10),
(67, 'ddad', '2020-04-14 19:55:31', 5, 10),
(68, '&lt;script&gt;alert(&quot;ok&quot;)&lt;/script&gt;', '2020-04-14 20:01:24', 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `moderateforum`
--

DROP TABLE IF EXISTS `moderateforum`;
CREATE TABLE IF NOT EXISTS `moderateforum` (
  `idModeration` int(11) NOT NULL AUTO_INCREMENT,
  `idQuestion` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `dateModif` datetime NOT NULL,
  PRIMARY KEY (`idModeration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modifyfaq`
--

DROP TABLE IF EXISTS `modifyfaq`;
CREATE TABLE IF NOT EXISTS `modifyfaq` (
  `idModification` int(11) NOT NULL AUTO_INCREMENT,
  `idQuestion` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `previousQuestion` text NOT NULL,
  `previousAnswer` text NOT NULL,
  `questionAfterModif` text NOT NULL,
  `answerAfterModif` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idModification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `idTest` int(11) NOT NULL AUTO_INCREMENT,
  `reactionTime` int(11) NOT NULL,
  `soundReproductionQuality` int(11) NOT NULL,
  `BPMAverage` int(11) NOT NULL,
  `temperatureAverage` int(11) NOT NULL,
  `dateTest` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idTest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `userPassword` text NOT NULL,
  `subDate` date NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `firstName`, `lastName`, `email`, `birthDate`, `gender`, `userPassword`, `subDate`, `age`) VALUES
(5, 'arnaud5', 'Guilhamat5', 'arnaud.guilhamat@sfr.fr', '2020-03-30', 'Homme', '4124bc0a9335c27f086f24ba207a4912', '0000-00-00', 0),
(6, 'arnaud6', 'Guilhamat6', 'arnaud.guilhamat@isep.fr', '2020-03-30', 'Autre', '4124bc0a9335c27f086f24ba207a4912', '0000-00-00', 0),
(7, 'arnaud7', 'Guilhamat7', 'guilhamat.arnaud@gmail.com', '2020-04-01', 'Homme', '4124bc0a9335c27f086f24ba207a4912', '0000-00-00', 0),
(10, 'arnaud10', 'Guilhamat8', 'a.gui@makl.co', '2020-03-30', 'Femme', '4124bc0a9335c27f086f24ba207a4912', '0000-00-00', 0),
(11, 'jeanb', 'dadaa', 'j.dad@g.m', '2020-03-30', 'Femme', '4124bc0a9335c27f086f24ba207a4912', '0000-00-00', 0),
(12, 'arnaud', 'Guilhamat', 'zaza.zaz@da.com', '2020-03-30', 'Femme', '4124bc0a9335c27f086f24ba207a4912', '2020-04-12', -1),
(13, 'arnaud', 'Guilhamat', 'grezq@afa.f', '2009-12-28', 'Femme', '4124bc0a9335c27f086f24ba207a4912', '2020-04-12', 10),
(15, 'arnaud', 'Guilhamat', 'aa.aa@a.f', '1999-01-07', 'Homme', '4124bc0a9335c27f086f24ba207a4912', '2020-04-12', 21),
(16, 'arnaud', 'Guilhamat', 'az.sa@sa', '2020-03-30', 'Femme', '0cc175b9c0f1b6a831c399e269772661', '2020-04-12', 0),
(17, 'arnaud', 'Guilhamat', 'azdaz@sa', '2021-01-05', 'Autre', '4124bc0a9335c27f086f24ba207a4912', '2020-04-12', -1),
(18, 'afaf', 'dazafa', 'dazdadaz@', '2020-04-01', 'Homme', '4124bc0a9335c27f086f24ba207a4912', '2020-04-01', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
