-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 juin 2022 à 08:27
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `homburger`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `NumCom` int NOT NULL AUTO_INCREMENT,
  `NomCom` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TelCom` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `AdrCom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `CPCom` char(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `VilleCom` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DateCom` date DEFAULT NULL,
  `HeureDispo` time DEFAULT NULL,
  `TypeEmbal` char(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `A_Livrer` char(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `EtatLivraison` char(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'Pas Livré',
  `CoutLiv` float DEFAULT NULL,
  `DateArchivCom` date DEFAULT NULL,
  `EtatCde` char(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'A Prepare',
  `TotalTTC` float DEFAULT NULL,
  `IdLiv` int DEFAULT NULL,
  PRIMARY KEY (`NumCom`),
  KEY `Commande_Livreur_FK` (`IdLiv`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`NumCom`, `NomCom`, `TelCom`, `AdrCom`, `CPCom`, `VilleCom`, `DateCom`, `HeureDispo`, `TypeEmbal`, `A_Livrer`, `EtatLivraison`, `CoutLiv`, `DateArchivCom`, `EtatCde`, `TotalTTC`, `IdLiv`) VALUES
(1, 'Torres', '0771718751', '59 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', 3, '2022-06-19', 'A Livrer', 15.5, 1),
(2, 'Corentin', '0771718751', '01 grande rue saint cosme', '71100', 'Chalon-sur-Sôane', '2022-03-18', '19:56:51', 'c', 'N', 'N', 3, '2022-06-19', 'A Livrer', 15.5, 1),
(12, 'Lilian Page', '0629584965', NULL, NULL, NULL, NULL, '16:03:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Livrer', NULL, NULL),
(13, 'coco', '0629584965', NULL, NULL, NULL, NULL, '17:03:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Livrer', NULL, NULL),
(14, 'eddy', '0629584965', NULL, NULL, NULL, NULL, '18:39:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Livrer', NULL, NULL),
(15, 'quentin', '0629584965', NULL, NULL, NULL, NULL, '17:56:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Livrer', NULL, NULL),
(16, 'diego', '0629584965', NULL, NULL, NULL, NULL, '16:15:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Livrer', NULL, NULL),
(17, 'Le COQ', '0123456789', NULL, NULL, NULL, NULL, '01:00:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-19', 'A Livrer', NULL, NULL),
(18, 'Lilian', '0606060606', NULL, NULL, NULL, NULL, '23:33:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-19', 'A Prepare', NULL, NULL),
(19, 'Lilian', '0123456789', NULL, NULL, NULL, NULL, '23:15:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-19', 'A Livrer', NULL, NULL),
(20, 'Lilian Page', '0123456789', '9 rue des albizias', '71640', 'Mellecey', NULL, '01:06:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(21, 'eddy', '0606060606', NULL, NULL, NULL, NULL, '00:23:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-19', 'A Livrer', NULL, NULL),
(22, 'coco', '0123456789', NULL, NULL, NULL, NULL, '00:55:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(23, 'Quentin', '0766766969', '6 rue du swag', '66769', 'SwagCity', NULL, '02:56:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(24, 'Lilian Page', '0606060606', NULL, NULL, NULL, NULL, '01:00:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(25, 'Lilian Page', '0629584965', '9 rue des albizias', '71640', 'Mellecey', NULL, '01:34:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(26, '', '', '', '', '', NULL, '00:34:00', NULL, NULL, 'T', NULL, '2022-06-20', 'A Livrer', NULL, 1),
(27, 'Lilian Page', '0629584965', '9 rue des albizias', '71640', 'Mellecey', NULL, '00:34:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(28, 'Lilian Page', '0629584965', '9 rue des albizias', '71640', 'Mellecey', NULL, '00:34:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(29, 'Lilian Page', '0629584965', '9 rue des albizias', '71640', 'Mellecey', NULL, '00:34:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(30, 'Lilian', '0606060606', NULL, NULL, NULL, NULL, '01:31:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(31, 'Lilian', '0629584965', NULL, NULL, NULL, NULL, '02:18:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(32, 'Lilian', '0606060606', NULL, NULL, NULL, NULL, '01:49:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(33, 'Lilian', '0123456789', NULL, NULL, NULL, NULL, '01:14:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(34, 'Lilian', '0123456789', NULL, NULL, NULL, NULL, '01:15:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(35, 'dieg', '0629584965', '9 rue des albizias', '71640', 'Mellecey', NULL, '03:03:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(36, 'Lilian', '0629584965', NULL, NULL, NULL, NULL, '01:21:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(37, 'Lilian', '0629584965', NULL, NULL, NULL, NULL, '01:27:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(38, 'Lilian', '0629584965', NULL, NULL, NULL, NULL, '01:29:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(39, 'Lilian', '0629584965', NULL, NULL, NULL, NULL, '01:34:00', NULL, NULL, 'Pas Livré', NULL, '2022-06-20', 'A Livrer', NULL, NULL),
(40, 'Lilian', '0629584965', NULL, NULL, NULL, NULL, '01:37:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL),
(41, 'Lilian Page', '0629584965', '9 rue des albizias', '71640', 'Mellecey', NULL, '01:39:00', NULL, NULL, 'Pas Livré', NULL, NULL, 'A Prepare', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commandefournisseur`
--

DROP TABLE IF EXISTS `commandefournisseur`;
CREATE TABLE IF NOT EXISTS `commandefournisseur` (
  `IdComFourn` int NOT NULL AUTO_INCREMENT,
  `IdIng` int NOT NULL,
  `NomFourn` char(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `QteComFourn` int NOT NULL,
  `DateLivFourn` date NOT NULL,
  `DateComFourn` date NOT NULL,
  PRIMARY KEY (`IdComFourn`),
  KEY `FK_IngredientCommande` (`IdIng`),
  KEY `FK_FournisseurCommande` (`NomFourn`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commandefournisseur`
--

INSERT INTO `commandefournisseur` (`IdComFourn`, `IdIng`, `NomFourn`, `QteComFourn`, `DateLivFourn`, `DateComFourn`) VALUES
(2, 13, 'MyFoodnisseur', 190, '2022-06-21', '2022-06-19'),
(4, 6, 'MyFoodnisseur', 9999, '2022-06-21', '2022-06-20');

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

DROP TABLE IF EXISTS `detail`;
CREATE TABLE IF NOT EXISTS `detail` (
  `Num_OF` int NOT NULL AUTO_INCREMENT,
  `NomProd` char(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Taille` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `IngBase1` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase2` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase3` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase4` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpt1` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpt2` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpt3` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpt4` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DateArchivDet` date DEFAULT NULL,
  `Quant` int NOT NULL,
  `NumCom` int NOT NULL,
  `IdProd_Produit` int NOT NULL,
  PRIMARY KEY (`Num_OF`),
  KEY `Detail_Commande_FK` (`NumCom`),
  KEY `Detail_Produit0_FK` (`IdProd_Produit`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `detail`
--

INSERT INTO `detail` (`Num_OF`, `NomProd`, `Taille`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngOpt1`, `IngOpt2`, `IngOpt3`, `IngOpt4`, `DateArchivDet`, `Quant`, `NumCom`, `IdProd_Produit`) VALUES
(1, 'Tac original', 'L', 'Pain s�same', 'Pain tacos', 'Boeuf', 'frite', 'Sauce Moustache', 'NULL', 'Boeuf', 'NULL', '2022-06-19', 1, 2, 4),
(2, 'Tac original', 'L', 'Pain s�same', 'Pain tacos', 'Boeuf', 'frite', 'Sauce Moustache', 'NULL', 'Boeuf', 'NULL', '2022-06-19', 1, 2, 4),
(13, 'Oburger', 'L', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', '2022-06-13', 1, 12, 3),
(14, 'Tac original', 'L', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', 'NULL', 'NULL', 'NULL', 'NULL', '2022-06-13', 1, 12, 4),
(15, 'Oburger', 'L', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', '2022-06-13', 4, 12, 3),
(16, 'Oburger', 'L', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', 'Sauce Moustache', 'Saucisses', 'Pain Sesame', 'Salade', '2022-06-13', 2, 14, 3),
(17, 'Oburger', 'L', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', '2022-06-13', 3, 14, 3),
(18, 'edyyburger', 'L', 'Pain Ble', 'Boeuf', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2022-06-13', 2, 15, 5),
(19, 'Tac original', 'L', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', 'NULL', 'NULL', 'Pain Sesame', 'NULL', '2022-06-19', 4, 17, 4),
(20, 'pain', 'M', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'Sauce Algérienne', 'Emmental', 'Poulet', 'NULL', '2022-06-19', 2, 18, 6),
(21, 'Tac original', 'L', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', 'aaaa', 'NULL', 'NULL', 'NULL', '2022-06-19', 1, 19, 4),
(22, 'pain', 'M', 'Pain Sesame', 'bbbbbbbbb', 'NULL', 'NULL', 'aaaaaaaaaaaaaaaaaaaa', 'NULL', 'NULL', 'NULL', '2022-06-19', 1, 19, 6),
(23, 'Pise Burger', 'L', 'Pain Ble', 'Boeuf', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 5, 19, 8),
(24, 'Cheh dessert', 'M', 'Pain Ble', 'Salade', 'NULL', 'NULL', 'Saucisses', 'Emmental', 'Boeuf', 'Poulet', '2022-06-20', 40, 20, 9),
(25, 'Tac original', 'L', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 2, 22, 4),
(26, 'CatBurger', 'L', 'Pain Ble', 'Boeuf', 'Poulet', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 100, 23, 7),
(27, 'CatBurger', 'L', 'Pain Ble', 'Boeuf', 'Poulet', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 2, 23, 7),
(28, 'pain', 'M', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'Barbecue', 'Emmental', 'Pain Sesame', 'Boeuf', NULL, 1, 25, 6),
(29, 'pain', 'M', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'Barbecue', 'Emmental', 'Pain Sesame', 'Boeuf', '2022-06-20', 1, 26, 6),
(30, 'pain', 'M', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'Barbecue', 'Emmental', 'Pain Sesame', 'Boeuf', '2022-06-20', 1, 27, 6),
(31, 'pain', 'M', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'Barbecue', 'Emmental', 'Pain Sesame', 'Boeuf', '2022-06-20', 1, 27, 6),
(32, 'pain', 'M', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'Barbecue', 'Emmental', 'Pain Sesame', 'Boeuf', '2022-06-20', 1, 28, 6),
(33, 'CrabZilla', 'L', 'Pain Sesame', 'Boeuf', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 29, 10),
(34, 'Cheh dessert', 'M', 'Pain Ble', 'Salade', 'NULL', 'NULL', 'Sauce Algérienne', 'Sauce Algérienne', 'Tomate', 'Tomate', NULL, 5, 30, 9),
(35, 'CrabZilla', 'L', 'Pain Sesame', 'Boeuf', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 32, 10),
(36, 'CrabZilla', 'L', 'Pain Sesame', 'Boeuf', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 33, 10),
(37, 'edyyburger', 'L', 'Pain Ble', 'Boeuf', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 100, 34, 5),
(38, 'Pise Burger', 'L', 'Pain Ble', 'Boeuf', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 34, 8),
(39, 'Oburger', 'L', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 36, 3),
(43, 'CatBurger', 'L', 'Pain Ble', 'Boeuf', 'Poulet', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 40, 7),
(44, 'CatBurger', 'L', 'Pain Ble', 'Boeuf', 'Poulet', 'Salade', 'NULL', 'NULL', 'NULL', 'NULL', NULL, 1, 41, 7);

-- --------------------------------------------------------

--
-- Structure de la table `det_ingr`
--

DROP TABLE IF EXISTS `det_ingr`;
CREATE TABLE IF NOT EXISTS `det_ingr` (
  `Num_OF` int NOT NULL,
  `IdIng` int NOT NULL,
  PRIMARY KEY (`Num_OF`,`IdIng`),
  KEY `DET_INGR_Ingredient0_FK` (`IdIng`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `NomFourn` char(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `AdresseFourn` char(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `CPFourn` char(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `VilleFourn` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TelFourn` char(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MailFourn` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DateArchivFourn` date DEFAULT NULL,
  PRIMARY KEY (`NomFourn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`NomFourn`, `AdresseFourn`, `CPFourn`, `VilleFourn`, `TelFourn`, `MailFourn`, `DateArchivFourn`) VALUES
('CocoTueur', 'taiwan', '12345', 'taiwan', '0123456678', 'taiwan.taiwan@taiwan', '2022-06-20'),
('Diego Torres', '1 rue du cnam', '71100', 'Chalon', '0123456789', 'diego.torres@lecnam.net', '2022-06-16'),
('Lilian  13', '9 rue des albizias', '71667', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page', '9 rue des albizias', '71640', 'Mellecey', '0123456789', 'lilian.page7111@gmail.com', NULL),
('Lilian Page10', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page11', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', '2022-06-19'),
('Lilian Page12', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', '2022-06-19'),
('Lilian Page2', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page3', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page4', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page5', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page6', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page7', '9 rue des albizias', '66666', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('Lilian Page8', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', '2022-06-14'),
('Lilian Page9', '9 rue des albizias', '71640', 'Mellecey', '0629584965', 'lilian.page7111@gmail.com', NULL),
('MyFoodnisseur', '23 Rue Alphonse Lamartine', '71100', 'Chalon-sur-saône', '0771718751', 'diego.publicmail@gmail.com', '2022-03-18'),
('Quentin', '9 rue du plouk', '71667', 'Equipe', '0123456789', 'quentin667.auditeur@lecnam.net', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fourn_ingr`
--

DROP TABLE IF EXISTS `fourn_ingr`;
CREATE TABLE IF NOT EXISTS `fourn_ingr` (
  `IdIng` int NOT NULL,
  `NomFourn` char(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PrixUHT` int NOT NULL,
  PRIMARY KEY (`IdIng`,`NomFourn`),
  KEY `FOURN_INGR_Fournisseur0_FK` (`NomFourn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gerant`
--

DROP TABLE IF EXISTS `gerant`;
CREATE TABLE IF NOT EXISTS `gerant` (
  `IdEmp` int NOT NULL AUTO_INCREMENT,
  `NomEmp` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PrenomEmp` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Identifient` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MDPEmp` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`IdEmp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `IdIng` int NOT NULL AUTO_INCREMENT,
  `NomIng` char(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Frais` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Type` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Unite` char(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `StockMin` int NOT NULL,
  `StockReel` float NOT NULL,
  `PrixUHT_Moyen` float NOT NULL,
  `Q_A_Com` int NOT NULL,
  `DateArchivIng` date DEFAULT NULL,
  PRIMARY KEY (`IdIng`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`IdIng`, `NomIng`, `Frais`, `Type`, `Unite`, `StockMin`, `StockReel`, `PrixUHT_Moyen`, `Q_A_Com`, `DateArchivIng`) VALUES
(1, 'Pain Sesame', 'F', 'P', '\"sans\"', 50, 150, 0.4, 0, '2022-03-18'),
(2, 'Pain Ble', 'F', 'P', '\"sans\"', 50, 150, 0.4, 0, '2022-03-18'),
(3, 'Boeuf', 'T', 'P', '\"sans\"', 50, 12808, 0.8, 0, '2022-03-18'),
(4, 'Poulet', 'T', 'P', '\"sans\"', 50, 198, 0.3, 0, '2022-03-18'),
(5, 'Salade', 'T', 'P', '\"sans\"', 50, 150, 0.2, 0, '2022-03-18'),
(6, 'Tomate', 'T', 'P', '\"sans\"', 50, 150, 0.2, 0, '2022-03-18'),
(7, 'Sauce Algérienne', 'F', 'S', '\"sans\"', 50, 150, 0.8, 0, '2022-03-18'),
(8, 'Sauce Burger', 'F', 'S', '\"sans\"', 50, 150, 0.3, 0, '2022-03-18'),
(9, 'Sauce Moustache', 'F', 'S', '\"sans\"', 50, 150, 0.2, 0, '2022-03-18'),
(10, 'Ketchup', 'F', 'S', '\"sans\"', 50, 150, 0.2, 0, '2022-03-18'),
(11, 'Barbecue', 'F', 'S', '\"sans\"', 50, 150, 0.2, 0, '2022-03-18'),
(12, 'Emmental', 'F', 'S', 'litres', 50, 200, 0.2, 0, '2022-03-18'),
(13, 'Saucisses', 'T', 'S', '', 50, 500, 5, 0, '2022-06-09');

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

DROP TABLE IF EXISTS `livreur`;
CREATE TABLE IF NOT EXISTS `livreur` (
  `IdLiv` int NOT NULL AUTO_INCREMENT,
  `NomLiv` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PrenomLiv` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `TelLiv` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `NumSSLiv` char(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DateArchivLiv` date DEFAULT NULL,
  PRIMARY KEY (`IdLiv`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `livreur`
--

INSERT INTO `livreur` (`IdLiv`, `NomLiv`, `PrenomLiv`, `TelLiv`, `NumSSLiv`, `DateArchivLiv`) VALUES
(1, 'Page', 'Lilian', '0771718751', '10364123587321', '2022-03-18'),
(2, 'Torres', 'Diego', '0771718751', '10364123587321', '2022-03-18');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `IdProd` int NOT NULL AUTO_INCREMENT,
  `NomProd` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Taille` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `NbIngBase` int NOT NULL,
  `NbIngOpt` int NOT NULL,
  `PrixUHT` float NOT NULL,
  `Image` char(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `IngBase1` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase2` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase3` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase4` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngBase5` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpti1` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpti2` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpti3` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpti4` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpti5` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IngOpti6` char(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `NbOptMax` int NOT NULL,
  `DateArchivProd` date DEFAULT NULL,
  `Incontournable` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`IdProd`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IdProd`, `NomProd`, `Taille`, `NbIngBase`, `NbIngOpt`, `PrixUHT`, `Image`, `IngBase1`, `IngBase2`, `IngBase3`, `IngBase4`, `IngBase5`, `IngOpti1`, `IngOpti2`, `IngOpti3`, `IngOpti4`, `IngOpti5`, `IngOpti6`, `NbOptMax`, `DateArchivProd`, `Incontournable`) VALUES
(3, 'Oburger', 'L', 4, 1, 9.99, '../img/Oburger.PNG', 'Pain sésame', 'Boeuf', 'Tomate', 'Salade', NULL, 'Sauce Moustache', NULL, NULL, NULL, NULL, NULL, 3, NULL, 'o'),
(4, 'Tac original', 'L', 4, 1, 11.99, '../img/Tac_Original.png', 'Pain sésame', 'Pain tacos', 'Boeuf', 'frite', NULL, 'Sauce Blanche', NULL, NULL, NULL, NULL, NULL, 3, NULL, 'n'),
(5, 'edyyburger', 'L', 2, 2, 30, '../img/burger3.jpg', 'Pain Ble', 'Boeuf', 'NULL', 'NULL', 'NULL', 'Sauce Burger', 'Ketchup', 'NULL', 'NULL', 'NULL', 'NULL', 3, NULL, 'o'),
(6, 'pain', 'M', 1, 0, 3, '../img/pain.jpg', 'Pain Sesame', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0, NULL, 'n'),
(7, 'CatBurger', 'L', 4, 2, 1000, '../img/ChatBurger.png', 'Pain Ble', 'Boeuf', 'Poulet', 'Salade', 'NULL', 'Sauce Moustache', 'Emmental', 'NULL', 'NULL', 'NULL', 'NULL', 3, NULL, 'o'),
(8, 'Pise Burger', 'L', 3, 2, 70, '../img/piseBurger.png', 'Pain Ble', 'Boeuf', 'Salade', 'NULL', 'NULL', 'Sauce Burger', 'Emmental', 'NULL', 'NULL', 'NULL', 'NULL', 5, NULL, 'o'),
(9, 'Cheh dessert', 'M', 2, 1, 5, '../img/chatBurgerDessert.png', 'Pain Ble', 'Salade', 'NULL', 'NULL', 'NULL', 'Sauce Moustache', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 3, NULL, 'n'),
(10, 'CrabZilla', 'L', 3, 1, 999, '../img/Crabzilla.png', 'Pain Sesame', 'Boeuf', 'Salade', 'NULL', 'NULL', 'Ketchup', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 3, NULL, 'o');

-- --------------------------------------------------------

--
-- Structure de la table `prod_ingr`
--

DROP TABLE IF EXISTS `prod_ingr`;
CREATE TABLE IF NOT EXISTS `prod_ingr` (
  `IdIng` int NOT NULL,
  `IdProd` int NOT NULL,
  `Quant` int NOT NULL,
  PRIMARY KEY (`IdIng`,`IdProd`),
  KEY `PROD_INGR_Produit0_FK` (`IdProd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prod_ingr`
--

INSERT INTO `prod_ingr` (`IdIng`, `IdProd`, `Quant`) VALUES
(2, 9, 2),
(3, 5, 600),
(5, 9, 5),
(8, 5, 10),
(9, 9, 100),
(10, 5, 10);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `Commande_Livreur_FK` FOREIGN KEY (`IdLiv`) REFERENCES `livreur` (`IdLiv`);

--
-- Contraintes pour la table `commandefournisseur`
--
ALTER TABLE `commandefournisseur`
  ADD CONSTRAINT `FK_FournisseurCommande` FOREIGN KEY (`NomFourn`) REFERENCES `fournisseur` (`NomFourn`),
  ADD CONSTRAINT `FK_IngredientCommande` FOREIGN KEY (`IdIng`) REFERENCES `ingredient` (`IdIng`);

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `Detail_Commande_FK` FOREIGN KEY (`NumCom`) REFERENCES `commande` (`NumCom`),
  ADD CONSTRAINT `Detail_Produit0_FK` FOREIGN KEY (`IdProd_Produit`) REFERENCES `produit` (`IdProd`);

--
-- Contraintes pour la table `det_ingr`
--
ALTER TABLE `det_ingr`
  ADD CONSTRAINT `DET_INGR_Detail_FK` FOREIGN KEY (`Num_OF`) REFERENCES `detail` (`Num_OF`),
  ADD CONSTRAINT `DET_INGR_Ingredient0_FK` FOREIGN KEY (`IdIng`) REFERENCES `ingredient` (`IdIng`);

--
-- Contraintes pour la table `fourn_ingr`
--
ALTER TABLE `fourn_ingr`
  ADD CONSTRAINT `FOURN_INGR_Fournisseur0_FK` FOREIGN KEY (`NomFourn`) REFERENCES `fournisseur` (`NomFourn`),
  ADD CONSTRAINT `FOURN_INGR_Ingredient_FK` FOREIGN KEY (`IdIng`) REFERENCES `ingredient` (`IdIng`);

--
-- Contraintes pour la table `prod_ingr`
--
ALTER TABLE `prod_ingr`
  ADD CONSTRAINT `PROD_INGR_Ingredient_FK` FOREIGN KEY (`IdIng`) REFERENCES `ingredient` (`IdIng`),
  ADD CONSTRAINT `PROD_INGR_Produit0_FK` FOREIGN KEY (`IdProd`) REFERENCES `produit` (`IdProd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
