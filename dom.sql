-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 10:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dom`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultet`
--

CREATE TABLE `fakultet` (
  `id` int(11) DEFAULT NULL,
  `naziv` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultet`
--

INSERT INTO `fakultet` (`id`, `naziv`) VALUES
(1, 'FON'),
(2, 'ETF'),
(3, 'FPN'),
(4, 'Saobracajni'),
(5, 'Medicinski');

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `idStud` int(11) NOT NULL,
  `brojSobe` int(11) NOT NULL,
  `datumPrijava` datetime NOT NULL,
  `datumOdjava` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`idStud`, `brojSobe`, `datumPrijava`, `datumOdjava`) VALUES
(37, 111, '2020-11-09 22:25:04', '2020-11-09 22:25:15'),
(37, 111, '2020-11-09 22:25:52', '2020-11-09 22:26:25'),
(37, 111, '2020-11-09 22:26:22', '2020-11-09 22:26:25'),
(37, 111, '2020-11-09 22:28:49', '2020-11-09 22:36:10'),
(38, 111, '2020-11-09 22:36:06', '2020-11-09 22:36:27'),
(37, 10, '2020-11-09 22:36:13', '2020-11-09 22:36:23'),
(38, 10, '2020-11-09 22:44:04', '2020-11-09 22:44:13'),
(37, 111, '2020-11-09 22:44:19', '2020-11-09 22:44:24'),
(38, 111, '2020-11-09 22:44:21', '2020-11-09 22:44:25'),
(39, 111, '2020-11-09 22:45:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soba`
--

CREATE TABLE `soba` (
  `idsobe` int(20) NOT NULL,
  `brojSobe` int(11) NOT NULL,
  `brojKreveta` int(11) NOT NULL,
  `brojDostupnihKreveta` int(11) NOT NULL,
  `pol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soba`
--

INSERT INTO `soba` (`idsobe`, `brojSobe`, `brojKreveta`, `brojDostupnihKreveta`, `pol`) VALUES
(2, 111, 3, 2, 'muski'),
(4, 333, 3, 3, 'zenski'),
(9, 10, 1, 1, 'muski'),
(10, 200, 3, 3, 'zenski'),
(11, 121, 2, 2, 'muski'),
(12, 352, 4, 4, 'zenski'),
(13, 199, 3, 3, 'muski');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idStudenta` int(20) NOT NULL,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `BrojIndeksa` varchar(20) NOT NULL,
  `Pol` varchar(10) NOT NULL,
  `Fakultet` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idStudenta`, `Ime`, `Prezime`, `BrojIndeksa`, `Pol`, `Fakultet`) VALUES
(37, 'Novak', 'Cojbasic', '23/17', 'muski', 'FON'),
(38, 'Jovan', 'Colovic', '1/20', 'muski', 'FPN'),
(39, 'Stojan', 'Vasic', '30/30', 'muski', 'Medicinski');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `soba`
--
ALTER TABLE `soba`
  ADD PRIMARY KEY (`idsobe`),
  ADD UNIQUE KEY `brojSobe` (`brojSobe`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudenta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `soba`
--
ALTER TABLE `soba`
  MODIFY `idsobe` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idStudenta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
