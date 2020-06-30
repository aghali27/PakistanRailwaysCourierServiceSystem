-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 10:17 PM
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
-- Table structure for table `sender_recieverdetails`
--

CREATE TABLE `sender_recieverdetails` (
  `package_pwblt_no` varchar(30) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_address` text NOT NULL,
  `sender_cnic` varchar(30) NOT NULL,
  `sender_phone` varchar(30) NOT NULL,
  `sender_email` varchar(40) NOT NULL,
  `reciever_name` text NOT NULL,
  `reciever_address` text NOT NULL,
  `reciever_cnic` varchar(30) NOT NULL,
  `reciever_phone` varchar(30) NOT NULL,
  `receiver_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sender_recieverdetails`
--
ALTER TABLE `sender_recieverdetails`
  ADD PRIMARY KEY (`package_pwblt_no`),
  ADD UNIQUE KEY `package_pwblt_no` (`package_pwblt_no`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sender_recieverdetails`
--
ALTER TABLE `sender_recieverdetails`
  ADD CONSTRAINT `sender_recieverdetails_ibfk_1` FOREIGN KEY (`package_pwblt_no`) REFERENCES `packagedetails` (`pwblt_No`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
