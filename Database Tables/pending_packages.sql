-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 10:16 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railwayproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `pending_packages`
--

CREATE TABLE `pending_packages` (
  `pwblt_No` varchar(30) NOT NULL,
  `from_st` text NOT NULL,
  `to_st` text NOT NULL,
  `transittype` text NOT NULL,
  `no_of_packages` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pending_packages`
--
ALTER TABLE `pending_packages`
  ADD KEY `fk_p_pid_idx` (`pwblt_No`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pending_packages`
--
ALTER TABLE `pending_packages`
  ADD CONSTRAINT `fk_p_pid` FOREIGN KEY (`pwblt_No`) REFERENCES `packagedetails` (`pwblt_No`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
