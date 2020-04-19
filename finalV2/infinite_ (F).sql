-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 19 avr. 2020 à 13:10
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
-- Structure de la table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrator`
--

INSERT INTO `administrator` (`idAdmin`, `idUser`) VALUES
(1, 10100);

-- --------------------------------------------------------

--
-- Structure de la table `ban`
--

DROP TABLE IF EXISTS `ban`;
CREATE TABLE IF NOT EXISTS `ban` (
  `idBan` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `dateBan` date NOT NULL,
  PRIMARY KEY (`idBan`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ban`
--

INSERT INTO `ban` (`idBan`, `idUser`, `dateBan`) VALUES
(114, 10102, '2020-04-17'),
(103, 10103, '2020-04-15'),
(112, 10055, '2020-04-16'),
(115, 10058, '2020-04-18');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idQuestion`, `textQuestion`, `textAnswer`, `isDeleted`) VALUES
(1, 'Ma question ?', 'Ma razeazeaze', 1),
(2, 'quesetion', 'aezaze', 1),
(3, 'question', 'Rponse', 1),
(4, 'aze', 'aze', 1),
(5, 'qscf', 'qsvqbqbbqqb', 1),
(6, 'aze', 'aze', 1),
(7, 'aze', 'aze', 1),
(8, 'aze', 'azeaze', 1),
(9, 'aze', 'azeaze', 1),
(10, 'aze', 'aze', 1),
(11, 'aze', 'aze', 1),
(12, 'Voici une question très souvent posée : \r\n\r\nQuelle est la couleur du cheval blanc d\'Henri IV ?', 'La réponse est pourtant évidente:\r\n\r\nLe cheval blanc d\'Henri IV est BLANC !', 0),
(13, 'Comment se déroulent les tests ?', 'Les tests se déroule de façon simple avec un gestionnaire qui vous sera attribué mais qui n\'est pas unique. \r\nPour ce qui est du test en lui-même, je vous invite à consulter la rubrique &quot;informations systèmes&quot;.', 0),
(14, 'bonojuor', 'azjkf', 1),
(15, 'Question', 'ceci est la question', 1),
(16, 'aze', 'aze', 1),
(17, 'a', 'a', 1),
(18, 'aze', 'aze', 1),
(19, 'aze', 'aze', 1),
(20, 'aze', 'aze', 1),
(21, 'aze', 'aze', 1),
(22, 'aze', 'aze', 1),
(23, 'bonjour', 'bonujour', 1),
(24, 'aze', 'aze', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_comments`
--

INSERT INTO `forum_comments` (`idComment`, `idTopic`, `idUser`, `date`, `text`) VALUES
(1, 1, 10100, '2020-04-17 09:49:32', 'Nous sommes le 17 mai'),
(2, 1, 10102, '2020-04-17 11:57:29', 'qzfqwgwb'),
(3, 3, 10100, '2020-04-18 23:00:04', 'aze'),
(4, 6, 10100, '2020-04-19 00:13:56', 'aze');

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
  `isClosed` tinyint(4) NOT NULL,
  PRIMARY KEY (`idTopic`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forum_topic`
--

INSERT INTO `forum_topic` (`idTopic`, `title`, `content`, `date`, `idUser`, `isClosed`) VALUES
(1, 'Jour d\'aujourd\'hui', 'Quel jour sommes nous ?', '2020-04-17 09:48:46', 10100, 0),
(2, 'Student', 'zqfv', '2020-04-17 11:57:23', 10102, 0),
(3, 'erzer', 'zer', '2020-04-17 12:12:34', 10100, 0),
(4, 'aze', 'aze', '2020-04-18 23:16:28', 10100, 0),
(5, 'aze', 'aze', '2020-04-18 23:16:31', 10100, 0),
(6, 'aze', 'aze', '2020-04-18 23:17:46', 10100, 0),
(7, 'aze', 'aze', '2020-04-18 23:17:52', 10100, 0),
(8, 'aze', 'aze', '2020-04-19 00:15:27', 10100, 0),
(9, 'nouveau topic', 'le 19 avril', '2020-04-19 00:15:47', 10100, 0);

-- --------------------------------------------------------

--
-- Structure de la table `imageprofil`
--

DROP TABLE IF EXISTS `imageprofil`;
CREATE TABLE IF NOT EXISTS `imageprofil` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `imageDirectory` varchar(255) NOT NULL,
  PRIMARY KEY (`idImage`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `imageprofil`
--

INSERT INTO `imageprofil` (`idImage`, `imageDirectory`) VALUES
(1, 'images/photoProfil/user.jpg'),
(11, 'images/photoProfil/jeremy/jpg'),
(12, 'images/photoProfil/jeremy.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `keyproduct`
--

DROP TABLE IF EXISTS `keyproduct`;
CREATE TABLE IF NOT EXISTS `keyproduct` (
  `idKey` int(11) NOT NULL AUTO_INCREMENT,
  `keyProd` int(8) NOT NULL,
  PRIMARY KEY (`idKey`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `keyproduct`
--

INSERT INTO `keyproduct` (`idKey`, `keyProd`) VALUES
(31, 132),
(30, 123344);

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `idManager` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `productKey` varchar(255) NOT NULL,
  PRIMARY KEY (`idManager`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manager`
--

INSERT INTO `manager` (`idManager`, `idUser`, `productKey`) VALUES
(11, 10055, '12334'),
(12, 10058, '123'),
(13, 10062, '123'),
(15, 10063, '123'),
(16, 10064, '123'),
(17, 10067, '123'),
(18, 10102, '123'),
(19, 10102, '123'),
(20, 10103, '123'),
(21, 10103, '123'),
(22, 10104, '123'),
(23, 10105, '123'),
(24, 10105, '123'),
(25, 10105, '123'),
(26, 10105, '123'),
(27, 10105, '123'),
(28, 10107, '123'),
(29, 10107, '123'),
(30, 10112, '123'),
(31, 10112, '123'),
(32, 10113, '123'),
(33, 10114, '123'),
(34, 10116, '123');

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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

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
(63, 'Jérémy', '2020-04-12 20:21:21', 16, 13),
(64, 'aze', '2020-04-16 21:27:00', 10100, 10055),
(65, 'aze', '2020-04-16 21:27:11', 10100, 10100),
(66, 'Bonjour administarteur', '2020-04-17 11:57:58', 10102, 10100),
(67, 'bonjour monsieur l\'admin', '2020-04-17 15:22:59', 10056, 10100),
(68, 'bonjour monsieur l\'admin', '2020-04-17 15:22:59', 10056, 10100),
(69, 'bonjour monsieur l\'admin', '2020-04-17 15:22:59', 10056, 10100),
(70, 'aze', '2020-04-19 11:35:58', 10100, 10055),
(71, 'admin', '2020-04-19 11:36:32', 10100, 10100),
(72, 'aze', '2020-04-19 15:08:46', 10100, 10056);

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
  `idImage` int(11) NOT NULL,
  `allow` int(1) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=10119 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `firstName`, `lastName`, `email`, `birthDate`, `gender`, `userPassword`, `subDate`, `age`, `idImage`, `allow`) VALUES
(10053, 'Jérémy', 'Iglicki', 'Jeremy.iglicki@gmail.com', '2020-04-09', 'aze', 'aze', '2020-04-15', 12, 0, 0),
(10054, 'Jeanlageou', 'azoeka', 'adre@z', '2020-05-01', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-14', -1, 0, 0),
(10055, 'Jérémy', 'Iglicki', 'ki@gmail.com', '2020-04-24', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-14', -1, 0, 0),
(10056, 'jean', 'lagourde', 'jean@lagourde', '2020-04-03', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-15', -1, 0, 0),
(10057, 'kraline', 'ch', 'krla@a', '2020-04-03', 'Autre', '0a5b3913cbc9a9092311630e869b4442', '2020-04-15', -1, 0, 0),
(10058, 'Iglicki', 'Jeremy', 'jeanlazerazrarde@gmail.com', '2020-04-23', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-15', -1, 0, 0),
(10059, 'iglicki', 'jeremy', 'jereki@gmail.com', '2020-04-09', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-15', -1, 0, 0),
(10064, 'Jérémy', 'Iglicki', 'azeazeazeaficki@gmail.com', '2020-04-03', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-15', -1, 0, 0),
(10100, 'admin', 'admin', 'admin@admin', '2020-04-22', 'ADMIN', '21232f297a57a5a743894a0e4a801fc3', '2020-04-29', 21, 1, 2),
(10115, 'aze', 'aze', 'azeazeazeazqs@faa', '2020-04-28', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-19', -1, 1, 0),
(10116, 'azgq', 'zgsq', 'hbefbf@bqzr', '2020-04-21', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-19', -1, 1, 1),
(10117, 'aze', 'aze', 'jojolala@lala', '2020-04-15', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-19', 0, 1, 0),
(10118, 'jean', 'lagourde', 'jojolagourde@aze', '2020-04-29', 'Homme', '0a5b3913cbc9a9092311630e869b4442', '2020-04-19', -1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
