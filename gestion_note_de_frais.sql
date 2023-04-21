-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 20 oct. 2022 à 11:50
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_note_de_frais`
--
CREATE DATABASE IF NOT EXISTS `gestion_note_de_frais` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestion_note_de_frais`;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_fc`
--

DROP TABLE IF EXISTS `ligne_fc`;
CREATE TABLE IF NOT EXISTS `ligne_fc` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Montant` float NOT NULL,
  `Justificatif` varchar(20) NOT NULL,
  `Id_ndf` int(20) NOT NULL,
  `Statut` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_3` (`Id_ndf`),
  KEY `fk_status` (`Statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_fk`
--

DROP TABLE IF EXISTS `ligne_fk`;
CREATE TABLE IF NOT EXISTS `ligne_fk` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Montant` float NOT NULL,
  `Justificatif` varchar(20) NOT NULL,
  `Id_ndf` int(20) NOT NULL,
  `Statut` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_idndf` (`Id_ndf`),
  KEY `fk_status_2` (`Statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note_de_frais`
--

DROP TABLE IF EXISTS `note_de_frais`;
CREATE TABLE IF NOT EXISTS `note_de_frais` (
  `Id_ndf` int(20) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Id_FC` int(20) DEFAULT NULL,
  `Id_FK` int(20) DEFAULT NULL,
  `Id_Utilisateur` int(20) DEFAULT NULL,
  PRIMARY KEY (`Id_ndf`),
  KEY `fk_2` (`Id_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

DROP TABLE IF EXISTS `statut`;
CREATE TABLE IF NOT EXISTS `statut` (
  `Label` varchar(20) NOT NULL,
  PRIMARY KEY (`Label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`Label`) VALUES
('Accepté'),
('En attente'),
('Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Mat` int(20) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Mail` varchar(20) NOT NULL,
  `Mdp` varchar(20) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`,`Mat`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id`, `Mat`, `Nom`, `Prenom`, `Mail`, `Mdp`, `Admin`) VALUES
(1, 6448723, 'Pignion', 'Louis', 'Louis@Pignion.fr', 'mdp', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Marque` varchar(20) NOT NULL,
  `Modele` varchar(20) NOT NULL,
  `Carburant` varchar(20) NOT NULL,
  `Cylindre` varchar(20) NOT NULL,
  `Id_utilisateur` int(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_utilisateur` (`Id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ligne_fc`
--
ALTER TABLE `ligne_fc`
  ADD CONSTRAINT `fk_3` FOREIGN KEY (`Id_ndf`) REFERENCES `note_de_frais` (`Id_ndf`),
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`Statut`) REFERENCES `statut` (`Label`);

--
-- Contraintes pour la table `ligne_fk`
--
ALTER TABLE `ligne_fk`
  ADD CONSTRAINT `fk_idndf` FOREIGN KEY (`Id_ndf`) REFERENCES `note_de_frais` (`Id_ndf`),
  ADD CONSTRAINT `fk_status_2` FOREIGN KEY (`Statut`) REFERENCES `statut` (`Label`);

--
-- Contraintes pour la table `note_de_frais`
--
ALTER TABLE `note_de_frais`
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`Id_Utilisateur`) REFERENCES `utilisateur` (`Id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`Id_utilisateur`) REFERENCES `utilisateur` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
