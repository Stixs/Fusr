-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 16 okt 2015 om 09:41
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `fusr`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `openingstijden`
--

CREATE TABLE IF NOT EXISTS `openingstijden` (
  `bedrijfs_id` int(11) NOT NULL,
  `maandag` varchar(13) NOT NULL,
  `dinsdag` varchar(13) NOT NULL,
  `woensdag` varchar(13) NOT NULL,
  `donderdag` varchar(13) NOT NULL,
  `vrijdag` varchar(13) NOT NULL,
  `zaterdag` varchar(13) NOT NULL,
  `zondag` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
