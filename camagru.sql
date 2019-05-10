-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  ven. 10 mai 2019 à 17:37
-- Version du serveur :  5.7.5-m15
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
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

CREATE TABLE `Comments` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `comment` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `publicationId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Likes`
--

CREATE TABLE `Likes` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `publicationId` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Likes`
--

INSERT INTO `Likes` (`id`, `publicationId`, `username`) VALUES
(46, '5cd55f716bbb5', 'jlange91'),
(48, '5cd566ae8458b', 'jlange91'),
(49, '5cd46f3528426', 'jlange91'),
(55, '5cd46f3528426', 'jlange'),
(63, '5cd57ed8a2c4c', 'jlange'),
(64, '5cd566ae8458b', 'jlange'),
(68, '5cd596618220a', 'jlange91'),
(69, '5cd596618220a', 'jlange'),
(73, '5cd596618220a', 'test'),
(74, '5cd5a1c5b0b37', 'test'),
(81, '5cd5a1c5b0b37', 'jlange'),
(82, '5cd5ad1709744', 'jlange'),
(83, '5cd5adda8acf2', 'jlange');

-- --------------------------------------------------------

--
-- Structure de la table `Publications`
--

CREATE TABLE `Publications` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `path` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `uniqid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Publications`
--

INSERT INTO `Publications` (`id`, `date`, `path`, `username`, `comment`, `uniqid`) VALUES
(1, '2019-05-09 18:13:54', '/var/www/assets/publication/5cd46de20a004.png', 'jlange', 'lol c drole', '5cd46de20a004'),
(2, '2019-05-09 18:15:59', '/var/www/assets/publication/5cd46e5f29744.png', 'jlange', 't es qui toi?', '5cd46e5f29744'),
(3, '2019-05-09 18:16:53', '/var/www/assets/publication/5cd46e957b897.png', 'jlange', 'coucou mÃ©mÃ©', '5cd46e957b897'),
(4, '2019-05-09 18:17:44', '/var/www/assets/publication/5cd46ec86093a.png', 'jlange', 'wtf?', '5cd46ec86093a'),
(5, '2019-05-09 18:18:49', '/var/www/assets/publication/5cd46f09eea1a.png', 'jlange', 'with my bro mario', '5cd46f09eea1a'),
(6, '2019-05-09 18:19:33', '/var/www/assets/publication/5cd46f3528426.png', 'jlange', 'fuck yeah', '5cd46f3528426'),
(7, '2019-05-09 21:26:05', '/var/www/assets/publication/5cd49aed48e8a.png', 'jlange', 'c est trop cool ca', '5cd49aed48e8a'),
(8, '2019-05-10 11:24:33', '/var/www/assets/publication/5cd55f716bbb5.png', 'jlange', 'trop bien lol\n', '5cd55f716bbb5'),
(9, '2019-05-10 11:55:26', '/var/www/assets/publication/5cd566ae8458b.png', 'jlange', '', '5cd566ae8458b'),
(10, '2019-05-10 13:38:32', '/var/www/assets/publication/5cd57ed8a2c4c.png', 'jlange', 'filtre mario', '5cd57ed8a2c4c'),
(11, '2019-05-10 14:25:37', '/var/www/assets/publication/5cd589e15d098.png', 'jlange', 'mdr c drole', '5cd589e15d098'),
(12, '2019-05-10 15:18:57', '/var/www/assets/publication/5cd596618220a.png', 'jlange', 'flowzer', '5cd596618220a'),
(13, '2019-05-10 15:20:49', '/var/www/assets/publication/5cd596d11978a.png', 'jlange', 'coucou maboy', '5cd596d11978a'),
(14, '2019-05-10 15:23:57', '/var/www/assets/publication/5cd5978d5ae43.png', 'jlange', 'Niquel', '5cd5978d5ae43'),
(15, '2019-05-10 16:07:33', '/var/www/assets/publication/5cd5a1c5b0b37.png', 'test', 'petit test', '5cd5a1c5b0b37'),
(16, '2019-05-10 16:55:51', '/var/www/assets/publication/5cd5ad1709744.png', 'jlange', 'tcho', '5cd5ad1709744'),
(17, '2019-05-10 16:59:06', '/var/www/assets/publication/5cd5adda8acf2.png', 'jlange', 'c est good', '5cd5adda8acf2');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `guid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(512) NOT NULL,
  `mailHash` varchar(256) NOT NULL,
  `sendMailDate` datetime NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `guid`, `email`, `username`, `password`, `mailHash`, `sendMailDate`, `completed`) VALUES
(1, '05069253-afb8-45bb-b428-c863ed9cd7e7', 'jlange@yopmail.com', 'jlange', 'ebca1f7579e7974687da693b17f6e2027fa3bad8737e158a3b8457fc92ce04c4da9f21f34fc031191101d90d3daca74efef35e2aa79e27367b37cd14db85640a', '', '2019-05-09 18:15:20', 1),
(2, '0146fc45-9edc-408a-8e20-057dacaf9665', 'jlange91@yopmail.com', 'jlange91', 'ebca1f7579e7974687da693b17f6e2027fa3bad8737e158a3b8457fc92ce04c4da9f21f34fc031191101d90d3daca74efef35e2aa79e27367b37cd14db85640a', '', '2019-05-10 13:22:35', 1),
(3, '3e1af4e4-757c-4726-aba0-7f141cdb7544', 'trucdemerde@yopmail.com', 'test', 'ebca1f7579e7974687da693b17f6e2027fa3bad8737e158a3b8457fc92ce04c4da9f21f34fc031191101d90d3daca74efef35e2aa79e27367b37cd14db85640a', '', '2019-05-10 16:07:52', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Publications`
--
ALTER TABLE `Publications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `Publications`
--
ALTER TABLE `Publications`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
