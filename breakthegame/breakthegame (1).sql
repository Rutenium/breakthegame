-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 17 Mars 2014 à 21:22
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `breakthegame`
--
CREATE DATABASE IF NOT EXISTS `breakthegame` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `breakthegame`;

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL COMMENT 'pts,lvl,secondes,minutes,etc',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `games`
--

INSERT INTO `games` (`id`, `name`, `types`) VALUES
(1, 'The Last Of Us!', 'seconds,minutes,hours'),
(2, 'Pokemon!', 'seconds,minutes,hours,level,hp');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `idgame` int(11) NOT NULL COMMENT 'id of the game in table game',
  `source` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idgame` (`idgame`),
  KEY `idgame_2` (`idgame`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `records`
--

INSERT INTO `records` (`id`, `record`, `type`, `idgame`, `source`, `description`) VALUES
(1, '100', 'level', 2, 'qyXTgqJtoGM', 'My pokemon is finally level 100!'),
(2, '3213', 'minutes', 1, 'dQw4w9WgXcQ', 'testestesfts'),
(3, '581', 'hp', 2, 'dQw4w9WgXcQ', 'POKEMON MAX HP! :D'),
(4, '4', 'hours', 2, 'aeM6wtVu6MQ', 'My speedrun of pokemon X!'),
(5, '3:14', 'hours', 1, 'dQw4w9WgXcQ', 'fast run!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
