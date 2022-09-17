-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Set 17, 2022 alle 11:56
-- Versione del server: 5.7.36
-- Versione PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powering`
--
DROP DATABASE IF EXISTS `powering`;
CREATE DATABASE IF NOT EXISTS `powering` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `powering`;

-- --------------------------------------------------------

--
-- Struttura della tabella `automezzo`
--

DROP TABLE IF EXISTS `automezzo`;
CREATE TABLE IF NOT EXISTS `automezzo` (
  `codice` int(11) NOT NULL AUTO_INCREMENT,
  `targa` varchar(7) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modello` varchar(50) DEFAULT NULL,
  `filiale` int(11) NOT NULL,
  PRIMARY KEY (`codice`),
  KEY `fk_filiale` (`filiale`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `automezzo`
--

INSERT INTO `automezzo` (`codice`, `targa`, `marca`, `modello`, `filiale`) VALUES
(1, 'AB123CD', 'Iveco', 'mod.1', 1),
(2, 'EF456GH', 'Scania', 'mod.2', 1),
(3, 'IL789MN', 'Mercedes', 'Mod.3', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `filiale`
--

DROP TABLE IF EXISTS `filiale`;
CREATE TABLE IF NOT EXISTS `filiale` (
  `codice` int(11) NOT NULL AUTO_INCREMENT,
  `indirizzo` varchar(100) DEFAULT NULL,
  `citta` varchar(50) DEFAULT NULL,
  `cap` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`codice`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `filiale`
--

INSERT INTO `filiale` (`codice`, `indirizzo`, `citta`, `cap`) VALUES
(1, 'Via Giovanni Pascoli n.5', 'Taranto', '74100'),
(2, 'Via Carlo Magno n.5', 'Bari', '70100'),
(3, 'Terza filiale', 'Brindisi', '12345');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `automezzo`
--
ALTER TABLE `automezzo`
  ADD CONSTRAINT `fk_filiale` FOREIGN KEY (`filiale`) REFERENCES `filiale` (`codice`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
