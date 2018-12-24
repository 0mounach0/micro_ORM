-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 24 Décembre 2018 à 18:11
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tmap`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `nom` varchar(36) NOT NULL,
  `descr` text,
  `tarif` decimal(10,2) DEFAULT NULL,
  `id_categ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `descr`, `tarif`, `id_categ`) VALUES
(64, 'velo', 'beau velo de course rouge', '59.95', 1),
(65, 'biclou', 'beau velo de course bleu', '214.56', 1),
(66, 'roller', 'roller presque neufs', '66.66', 1),
(122, 'mounach', 'mounach', '10.20', 1),
(123, 'mounach88', 'd', '10.00', 1),
(124, 'mounach', 'desc2', '22.00', 1),
(125, 'mounach7777', 'desc2', '22.00', 1),
(126, 'article 808', 'desc 808', '88.00', 2),
(129, 'article 808', 'desc 808', '88.00', 2),
(130, 'article 808', 'desc 808', '88.00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `descr` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `descr`) VALUES
(1, 'sport', 'articles de sport'),
(2, 'cat2', 'desc2'),
(3, 'cat2', 'desc2'),
(4, 'cat 808', 'desc 808'),
(5, 'cat 808', 'desc 808'),
(6, 'cat 808', 'desc 808'),
(7, 'cat 808', 'desc 808'),
(8, 'cat 808', 'desc 808');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
