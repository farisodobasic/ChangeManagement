-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2016 at 04:17 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `change`
--

CREATE TABLE IF NOT EXISTS `change` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `datum` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `prioritet` int(11) NOT NULL,
  `naslov` varchar(50) NOT NULL,
  `razlog` varchar(100) NOT NULL,
  `budzet` double NOT NULL,
  `benefit` varchar(100) NOT NULL,
  `posljedice` varchar(100) NOT NULL,
  `rizik` varchar(100) NOT NULL,
  `vrijemeizvedbe` int(11) NOT NULL,
  `odobrenmanager` int(11) NOT NULL DEFAULT '0',
  `odobrencab` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `change_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `vrijeme` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tekst` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `change_id_fk` (`change_id`),
  KEY `autor_id_fk` (`autor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type`) VALUES
(2, 'faris', 'faris@gmail.com', '7d77e825b80cff62a72e680c1c81424f', 0),
(3, 'orhan', 'orhan@gmail.com', '061cd5c17399f24dd6fabccb96c57462', 0),
(5, 'manager', 'change@management.com', '1d0258c2440a8d19e716292b231e3190', 1),
(6, 'cab', 'cab@management.com', '16ecfd64586ec6c1ab212762c2c38a90', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `change`
--
ALTER TABLE `change`
  ADD CONSTRAINT `change_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`change_id`) REFERENCES `change` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
