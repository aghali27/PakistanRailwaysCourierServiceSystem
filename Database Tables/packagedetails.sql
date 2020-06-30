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
-- Table structure for table `packagedetails`
--

CREATE TABLE `packagedetails` (
  `pwblt_No` varchar(30) NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `description` text NOT NULL,
  `total_packages` int(11) NOT NULL,
  `weightkg` float NOT NULL,
  `weightton` float NOT NULL,
  `value_of_package` int(11) NOT NULL,
  `risk_form` varchar(11) NOT NULL,
  `cash_paid` int(11) NOT NULL,
  `status` text NOT NULL,
  `date_booked` date NOT NULL,
  `time_booked` time NOT NULL,
  `date_departure` date NOT NULL,
  `date_recieved` date NOT NULL,
  `godown_type` text NOT NULL,
  `booking_officer_id` int(11) NOT NULL,
  `b_officer_name` text NOT NULL,
  `recieving_packages` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packagedetails`
--
ALTER TABLE `packagedetails`
  ADD PRIMARY KEY (`pwblt_No`),
  ADD UNIQUE KEY `pwblt_No` (`pwblt_No`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
