-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 14 fév. 2022 à 08:14
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 8.0.13

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
CREATE DATABASE IF NOT EXISTS `escape_game` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `escape_game`;

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
  PRIMARY KEY (`room_id`,`schedule_id`,`date`),
  KEY `customer_id` (`customer_id`),
  KEY `fk_schedule_booking` (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`room_id`, `customer_id`, `schedule_id`, `date`, `nb_player`, `total_price`) VALUES
(2, 1, 5, '2022-02-11', 6, 132),
(2, 2, 6, '2022-02-11', 6, 132),
(4, 2, 5, '2022-02-11', 8, 176);

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
(1, 'Yann', 'Serinet', 'yann.srt@gmail.com'),
(2, 'Jean', 'Dupond', 'test@yopmail.com');

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
  `new` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `duration`, `forbidden18yearOld`, `niveau`, `min_player`, `max_player`, `age`, `img_css`, `new`) VALUES
(1, 'Le château ambulant', 'Mince, Hauru s’est fait capturer par l’armée. Vous devez le libérer mais malheureusement la porte est fermée. Trouver la clé pour utiliser la porte magique afin de libérer Hauru. Faite vous aider par Calcifer et épouvantail enchanté. Mais attention de ne pas vous tromper car chaque erreur commise rapproche la Sorcière des Landes du château.', 70, 0, 'Facile', 4, 12, 16, 'roomCard4Img', 1),
(2, 'La \nsalle \n de l\'horreur', 'ceci est une description', 60, 0, 'Normal', 3, 6, 17, 'roomCard1Img', 0),
(3, 'fsdffdssf', 'sddfsdf', 60, 0, 'Normal', 5, 7, 18, 'roomCard2Img', 0),
(4, 'Horreurdfsdfsdff', 'sddfsdf', 60, 0, 'Normal', 2, 11, 19, 'roomCard3Img', 0);

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
