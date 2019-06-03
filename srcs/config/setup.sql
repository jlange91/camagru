-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 03, 2019 at 09:01 AM
-- Server version: 5.7.5-m15
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `date` datetime NOT NULL,
  `comment` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `publicationId` varchar(255) NOT NULL,
  `uniqid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`date`, `comment`, `username`, `publicationId`, `uniqid`) VALUES
('2019-06-03 08:43:38', 'nice', 'dlange91', '5cf4dca476d56', '5cf4ddba49384'),
('2019-06-03 10:48:16', 'trop cool', 'dlange91', '5cf4de567a4b1', '5cf4ded0ef0b0'),
('2019-06-03 10:53:28', 'top chantal ðŸ™‹â€â™‚ï¸', 'jlange', '5cf4de567a4b1', '5cf4e0088b2a1');

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `publicationId` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Likes`
--

INSERT INTO `Likes` (`publicationId`, `username`) VALUES
('5cf4dca476d56', 'dlange91'),
('5cf4dca476d56', 'jlange'),
('5cf4de1bc8e89', 'dlange91'),
('5cf4e0e48ca9f', 'jlange'),
('5cf4e156cd098', 'dlange91');

-- --------------------------------------------------------

--
-- Table structure for table `Publications`
--

CREATE TABLE `Publications` (
  `date` datetime NOT NULL,
  `path` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `uniqid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Publications`
--

INSERT INTO `Publications` (`date`, `path`, `username`, `comment`, `uniqid`) VALUES
('2019-06-03 08:39:00', '/var/www/assets/publication/5cf4dca476d56.png', 'jlange', 'trop cool', '5cf4dca476d56'),
('2019-06-03 08:45:15', '/var/www/assets/publication/5cf4de1bc8e89.png', 'dlange91', 'ðŸ”¥', '5cf4de1bc8e89'),
('2019-06-03 08:46:14', '/var/www/assets/publication/5cf4de567a4b1.png', 'dlange91', 'chantal ðŸŒ¸', '5cf4de567a4b1'),
('2019-06-03 10:54:38', '/var/www/assets/publication/5cf4e04e78a34.png', 'jlange', 'ðŸ‘®â€â™€ï¸', '5cf4e04e78a34'),
('2019-06-03 10:57:08', '/var/www/assets/publication/5cf4e0e48ca9f.png', 'jlange', 'rick & morty ðŸ‘€', '5cf4e0e48ca9f'),
('2019-06-03 10:59:02', '/var/www/assets/publication/5cf4e156cd098.png', 'dlange91', 'Mario world ðŸŒˆ', '5cf4e156cd098');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `email` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(512) NOT NULL,
  `mailHash` varchar(256) NOT NULL,
  `resetPasswordHash` varchar(256) NOT NULL,
  `sendMailDate` datetime NOT NULL,
  `sendMailComment` tinyint(1) NOT NULL DEFAULT '1',
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`email`, `username`, `password`, `mailHash`, `resetPasswordHash`, `sendMailDate`, `sendMailComment`, `completed`) VALUES
('dlange91@yopmail.com', 'dlange91', '295be70aca114d13779236f67602ef4375b8203e560e204dac759f3c1729ab74d2b02ef5cf7d200f330ac5c43efc7466c037134ac3a2ee6bc1dbf3614f3473c4', '01b5dea3277c4fb62aa2f565eb563fef5d1f25f48ae64b3f1f0d8341777493e9', '', '2019-06-03 08:44:57', 1, 1),
('jlange@yopmail.com', 'jlange', 'ebca1f7579e7974687da693b17f6e2027fa3bad8737e158a3b8457fc92ce04c4da9f21f34fc031191101d90d3daca74efef35e2aa79e27367b37cd14db85640a', '', '', '2019-06-03 08:40:36', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`uniqid`);

--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`publicationId`,`username`);

--
-- Indexes for table `Publications`
--
ALTER TABLE `Publications`
  ADD PRIMARY KEY (`uniqid`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
