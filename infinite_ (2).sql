-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 06 avr. 2020 à 15:45
-- Version du serveur :  10.0.38-MariaDB-0+deb8u1
-- Version de PHP :  7.3.13

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
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `idAdmin` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `DeleteFaq`
--

CREATE TABLE `DeleteFaq` (
  `idDelete` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Faq`
--

CREATE TABLE `Faq` (
  `idQuestion` int(11) NOT NULL,
  `textQuestion` text NOT NULL,
  `textAnswer` text NOT NULL,
  `isDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Forum`
--

CREATE TABLE `Forum` (
  `idQuestion` int(11) NOT NULL,
  `titleQuestion` text NOT NULL,
  `textQuestion` text NOT NULL,
  `date` datetime NOT NULL,
  `idWriter` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Manager`
--

CREATE TABLE `Manager` (
  `idManager` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `productKey` varchar(255) NOT NULL,
  `managerPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Messaging`
--

CREATE TABLE `Messaging` (
  `idMessage` int(11) NOT NULL,
  `subject` text NOT NULL,
  `textMessage` text NOT NULL,
  `date` datetime NOT NULL,
  `idWritter` int(11) NOT NULL,
  `idReceiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ModerateForum`
--

CREATE TABLE `ModerateForum` (
  `idModeration` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `dateModif` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ModifyFaq`
--

CREATE TABLE `ModifyFaq` (
  `idModification` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `previousQuestion` text NOT NULL,
  `previousAnswer` text NOT NULL,
  `questionAfterModif` text NOT NULL,
  `answerAfterModif` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Test`
--

CREATE TABLE `Test` (
  `idTest` int(11) NOT NULL,
  `reactionTime` int(11) NOT NULL,
  `soundReproductionQuality` int(11) NOT NULL,
  `BPMAverage` int(11) NOT NULL,
  `temperatureAverage` int(11) NOT NULL,
  `dateTest` datetime NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `DeleteFaq`
--
ALTER TABLE `DeleteFaq`
  ADD PRIMARY KEY (`idDelete`);

--
-- Index pour la table `Faq`
--
ALTER TABLE `Faq`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `Forum`
--
ALTER TABLE `Forum`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `Manager`
--
ALTER TABLE `Manager`
  ADD PRIMARY KEY (`idManager`);

--
-- Index pour la table `Messaging`
--
ALTER TABLE `Messaging`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `ModerateForum`
--
ALTER TABLE `ModerateForum`
  ADD PRIMARY KEY (`idModeration`);

--
-- Index pour la table `ModifyFaq`
--
ALTER TABLE `ModifyFaq`
  ADD PRIMARY KEY (`idModification`);

--
-- Index pour la table `Test`
--
ALTER TABLE `Test`
  ADD PRIMARY KEY (`idTest`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `DeleteFaq`
--
ALTER TABLE `DeleteFaq`
  MODIFY `idDelete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Faq`
--
ALTER TABLE `Faq`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Forum`
--
ALTER TABLE `Forum`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Manager`
--
ALTER TABLE `Manager`
  MODIFY `idManager` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Messaging`
--
ALTER TABLE `Messaging`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ModerateForum`
--
ALTER TABLE `ModerateForum`
  MODIFY `idModeration` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ModifyFaq`
--
ALTER TABLE `ModifyFaq`
  MODIFY `idModification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Test`
--
ALTER TABLE `Test`
  MODIFY `idTest` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
