-- UPDATE METADATA!
-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Feb 2016 um 22:07
-- Server-Version: 10.1.9-MariaDB
-- PHP-Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdb`
--

-- --------------------------------------------------------

--
-- Table structure for table 'person'
--
CREATE TABLE `person` (
  `id` int(4) NOT NULL,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hnr` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `climate_data` (
  `time_id` int(4) NOT NULL,
  `meta_id` int(4) NOT NULL,
  `datestamp` int(20) NOT NULL,
  `timestamp` text(20) NOT NULL,
  `climate_value` float(20) NOT NULL,
  `data_type` text(40) NOT NULL,
  UNIQUE (`meta_id`, `datestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `meta_data` (
  `Data_name` text(40) NOT NULL,
  `DataT` text(40) NOT NULL,
  `Descr` text(50) NOT NULL,
  `rstat` text(20) NOT NULL,
  `rdesc` text(40) NOT NULL,
  `start` text(20) NOT NULL,
  `enddt` text(40) NOT NULL,
  `naval` text(10) NOT NULL,
  `tstep` text(20) NOT NULL,
  `respo` text(40) NOT NULL,
  `metad` text(40) NOT NULL,
  `sname` text(40) NOT NULL,
  `River` text(40) NOT NULL,
  `Latcr` text(40) NOT NULL,
  `Loncr` text(40) NOT NULL,
  `utmzn` text(40) NOT NULL,
  `eleva` text(40) NOT NULL,
  `yearE` text(10) NOT NULL,
  `yearC` text(10) NOT NULL,
  `rarea` text(40) NOT NULL,
  `statd` text(40) NOT NULL,
  `respp` text(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- data for table `person`
--
-- password must be hashed. password $2y$10$5XaVSHBJWZFigRRUReuCAerKJW/XFHNjcd08ykua7svcUVU8S.ndq means 'secret'
INSERT INTO `person` (`id`, `status`, `firstname`, `lastname`,  `login`, `street`, `hnr`, `postcode`, `town`, `country`, `email`, `phone`, `password`) VALUES
(1, 'admin', 'Luise', 'Treumer', 'ltreum', 'Bibliotheksweg', '5', '07743', 'Jena', 'Germany', 'luise.treumer@uni-jena.de', '0461456', '$2y$10$5XaVSHBJWZFigRRUReuCAerKJW/XFHNjcd08ykua7svcUVU8S.ndq'),
(2, 'user', 'Anna', 'Blum', 'annab', 'Grietgasse', '6', '07743', 'Jena', 'Germany', 'anna.blum@uni-jena.de', '01772828', '$2y$10$5XaVSHBJWZFigRRUReuCAerKJW/XFHNjcd08ykua7svcUVU8S.ndq');
--
-- indices of exported tables
--
--
-- indices of table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `login` (`login`),
  ADD KEY `street` (`street`),
  ADD KEY `hnr` (`hnr`),
  ADD KEY `postcode` (`postcode`),
  ADD KEY `town` (`town`),
  ADD KEY `country` (`country`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for exported tbales
--

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
