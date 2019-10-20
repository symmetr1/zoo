-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2019 at 02:30 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `areaID` int(11) NOT NULL,
  `areaName` varchar(64) DEFAULT NULL,
  `accessType` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`areaID`, `areaName`, `accessType`) VALUES
(1, 'Africa', 0),
(2, 'Asia', 0),
(3, 'Europe', 0),
(4, 'North America', 0),
(5, 'South America', 1),
(6, 'Australia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exhibits`
--

CREATE TABLE `exhibits` (
  `exhibitID` int(11) NOT NULL,
  `exhibitName` varchar(64) DEFAULT NULL,
  `areaID` int(11) DEFAULT NULL,
  `isopen` tinyint(1) DEFAULT NULL,
  `pictureurl` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exhibits`
--

INSERT INTO `exhibits` (`exhibitID`, `exhibitName`, `areaID`, `isopen`, `pictureurl`) VALUES
(1, 'Lion', 1, 0, 'lion.jpg'),
(2, 'Giraffe', 1, 1, 'giraffe.jpg'),
(3, 'Antelope', 1, 1, 'antelope.jpg'),
(4, 'Panda', 2, 1, 'panda.jpg'),
(5, 'Tiger', 2, 1, 'tiger.jpg'),
(6, 'Yunnan Monkey', 2, 1, 'snubnose.jpg'),
(7, 'Lynx', 3, 1, 'lynx.jpg'),
(8, 'Pine Marten', 3, 1, 'marten.jpg'),
(9, 'Wolverine', 3, 0, 'wolverine.jpg'),
(10, 'Mosquito', 4, 1, 'mosquito.jpg'),
(11, 'Raccoon', 4, 1, 'raccoon.jpg'),
(12, 'Opposum', 4, 1, 'opossum.jpg'),
(13, 'Sloth', 5, 0, 'sloth.jpg'),
(14, 'Toucan', 5, 1, 'toucan.jpg'),
(15, 'Cheetah', 5, 1, 'cheetah.jpg'),
(16, 'Koala', 6, 1, 'koala.jpg'),
(17, 'Platypus', 6, 1, 'platypus.jpg'),
(18, 'Kangaroo', 6, 1, 'kangaroo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` mediumint(9) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isadmin` tinyint(1) NOT NULL,
  `ticketExpiration` date DEFAULT NULL,
  `allAreas` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `isadmin`, `ticketExpiration`, `allAreas`) VALUES
(1, 'don', '$2y$10$rDGvqt4p4Q4rutsO9HCiL.6x/7IiWhGY7dAK5r4KRdhP.0hn/bSee', 1, NULL, NULL),
(2, 'joebob', '$2y$10$rDGvqt4p4Q4rutsO9HCiL.6x/7IiWhGY7dAK5r4KRdhP.0hn/bSee', 0, '2020-07-18', 1),
(3, 'gary', '$2y$10$rDGvqt4p4Q4rutsO9HCiL.6x/7IiWhGY7dAK5r4KRdhP.0hn/bSee', 1, NULL, NULL),
(4, 'kathysue', '$2y$10$rDGvqt4p4Q4rutsO9HCiL.6x/7IiWhGY7dAK5r4KRdhP.0hn/bSee', 0, '2022-12-16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`areaID`);

--
-- Indexes for table `exhibits`
--
ALTER TABLE `exhibits`
  ADD PRIMARY KEY (`exhibitID`),
  ADD KEY `exhibits_areas__fk` (`areaID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `areaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exhibits`
--
ALTER TABLE `exhibits`
  MODIFY `exhibitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exhibits`
--
ALTER TABLE `exhibits`
  ADD CONSTRAINT `exhibits_areas__fk` FOREIGN KEY (`areaID`) REFERENCES `areas` (`areaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
