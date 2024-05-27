-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 mai 2024 à 12:39
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kultureverse`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_general_ci NOT NULL,
  `reponse` tinyint(1) NOT NULL,
  `id_quizz` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quizz` (`id_quizz`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `reponse`, `id_quizz`) VALUES
(17, 'Le skate-board est-il une discipline des Jeux Olympiques ?', 1, 15),
(16, 'Le skate-board a été inventé autours de 1950 ?', 1, 15),
(18, 'Plus de 4 millions de tonnes de déchets sont jeté dans l’océan chaque années ?', 1, 14);

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`id`, `nom`, `image`, `description`) VALUES
(14, 'Océan', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.americanoceans.org%2Fwp-content%2Fuploads%2F2023%2F01%2FPacific-ocean-horizon.jpg&amp;f=1&amp;nofb=1&amp;ipt=f23e002ccbaee985a478ed979d690aa04e6bb3b0b48f524c8c2213d383d96922&amp;ipo=images', 'Test tes connaissances sur les différents océans du monde'),
(15, 'SkateBoard', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fjooinn.com%2Fimages%2Fskateboarding-1.jpg&amp;f=1&amp;nofb=1&amp;ipt=e48b183150ba9b7288972457fd53dd2b66fd0f6213e8b8825901ca021bb08809&amp;ipo=images', 'Connais tu beaucoup de choses sur le Skate-board ? Teste tes connaissances avec ce quizz');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_quizz` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `total_questions` int NOT NULL,
  `score` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quizz` (`id_quizz`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id`, `id_quizz`, `id_user`, `total_questions`, `score`) VALUES
(1, 5, 4, 2, 2),
(2, 5, 4, 2, 1),
(3, 5, 4, 2, 0),
(4, 1, 4, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email_adress` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email_adress`, `password`, `isAdmin`) VALUES
(2, 'qheritier', 'quentheritier@gmail.com', '$2y$10$oR1o7KLbnYKoMXn4.725YuNuOIUrnJKTc32iKf1lbsHHNl7xTLsLu', 1),
(4, 'TEST', 'user@gmail.com', '$2y$10$0msO3VkRQdKzohTTKujHLOybQ0KyvbMSR8Rqbomhah.O/1R.VGhQa', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
