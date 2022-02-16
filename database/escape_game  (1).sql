-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 15 fév. 2022 à 08:59
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `escape_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `room_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nb_player` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`room_id`,`customer_id`,`schedule_id`),
  KEY `fk_customers_booking` (`customer_id`),
  KEY `fk_schedule_booking` (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`room_id`, `customer_id`, `schedule_id`, `date`, `nb_player`, `total_price`) VALUES
(1, 1, 7, '2022-01-28', 5, 150),
(1, 2, 1, '2022-01-28', 12, 240),
(1, 2, 7, '2022-03-27', 10, 200),
(2, 1, 3, '2022-03-09', 0, 70),
(3, 1, 3, '2022-03-15', 12, 240),
(4, 1, 3, '2022-02-11', 0, 50),
(6, 1, 7, '2022-01-28', 5, 150),
(6, 2, 1, '2022-03-03', 0, 20),
(7, 1, 7, '2022-02-09', 0, 150),
(7, 2, 9, '2022-02-22', 0, 120);

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`) VALUES
(1, 'Arthur', 'Broussoux', 'abroussoux@gmail.com'),
(2, 'Delattre', 'Thomas', 'lebogossedu62@skyblog.fr');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 60,
  `forbidden18yearOld` tinyint(1) NOT NULL DEFAULT 0,
  `niveau` enum('Facile','Normal','Difficile') NOT NULL DEFAULT 'Normal',
  `min_player` int(11) NOT NULL DEFAULT 2,
  `max_player` int(11) NOT NULL DEFAULT 12,
  `age` int(11) NOT NULL DEFAULT 16,
  `img_css` enum('roomCard1Img','roomCard2Img','roomCard3Img','roomCard4Img') NOT NULL DEFAULT 'roomCard2Img',
  `new` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `duration`, `forbidden18yearOld`, `niveau`, `min_player`, `max_player`, `age`, `img_css`, `new`) VALUES
(1, 'le chateau ambulant', 'Mince, Hauru s\'est fait capturer par l\'armée. Vous devez le libérer mais malheureusement la porte est fermée. Trouver la clé pour utiliser la porte magique afin de libérer Hauru. Faite vous aider par Calcifier et épouvantail enchanté. Mais attention de ne pas vous tromper car chaque erreur commise rapproche la Sorcière des Landes du château.', 60, 0, 'Facile', 4, 8, 12, 'roomCard2Img', 0),
(2, 'chucky', 'Vous vous retrouvez au beau milieu d\'une scène du célèbre film d\'horreur \"Chucky\". Vous allez devoir garder votre sang froid si vous voulez vous en sortir vivant !! Dans une ambiance oppressante, tentez de venir à bout de tous les pièges et manigances que vous a réservé la poupée maléfique.', 70, 1, 'Difficile', 2, 12, 18, 'roomCard1Img', 0),
(3, 'Les sous-terrains de Bordeaux', 'Vous êtes inspecteur à la brigade criminelle de la police de Bordeaux et enquêtez sur une sombre histoire de meutre qui vous mène à travers les souterrains de Bordeaux. Attention le chronomètre est lancé !! Réussirez-vous à résoudre le mystère avant que le niveau de l’eau n’emporte les preuves et vous avec…', 70, 0, 'Normal', 4, 12, 16, 'roomCard2Img', 0),
(4, 'Squid Game', 'Bienvenue au Squid Game !!! Tentez de gagner le gros lot !! Mais avant ça, vous allez devoir faire preuve de malice et d’audace afin de venir à bout des énigmes du jeu… A propos du jeu, vous jouez en équipe ou les uns contre les autres… Venez le découvrir !!\r\n\r\n', 50, 1, 'Difficile', 4, 12, 18, 'roomCard3Img', 1),
(6, 'Room des noobs', 'Blablala', 60, 0, 'Difficile', 2, 12, 12, 'roomCard2Img', 0),
(7, 'X GAME ', 'C\'est chaud c\'est chaud', 120, 1, 'Difficile', 8, 12, 21, 'roomCard4Img', 0);

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `schedule`
--

INSERT INTO `schedule` (`id`, `heure`) VALUES
(1, '10:30:00'),
(2, '12:00:00'),
(3, '13:30:00'),
(4, '15:00:00'),
(5, '16:30:00'),
(6, '18:00:00'),
(7, '19:30:00'),
(8, '21:00:00'),
(9, '22:30:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_customers_booking` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `fk_rooms_booking` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `fk_schedule_booking` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
