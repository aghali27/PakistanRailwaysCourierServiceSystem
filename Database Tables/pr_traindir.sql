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
-- Table structure for table `pr_traindir`
--

CREATE TABLE `pr_traindir` (
  `train_code` bigint(22) UNSIGNED NOT NULL,
  `train_name` varchar(255) DEFAULT NULL,
  `train_direction` varchar(2) DEFAULT NULL,
  `train_origan` varchar(255) DEFAULT NULL,
  `train_destination` varchar(255) DEFAULT NULL,
  `train_cat` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pr_traindir`
--

INSERT INTO `pr_traindir` (`train_code`, `train_name`, `train_direction`, `train_origan`, `train_destination`, `train_cat`) VALUES
(1, 'Khyber Mail', 'UP', 'KARACHI CANT', 'PESHAWAR CANT', 0),
(2, 'Khyber Mail', 'DN', 'PESHAWAR CANT', 'KARACHI CANT', 0),
(3, 'Bolan Mail', 'UP', 'KARACHI CITY', 'QUETTA', 0),
(4, 'Bolan Mail', 'DN', 'QUETTA', 'KARACHI CITY', 0),
(5, 'Green Line', 'UP', 'KARACHI CANT', 'MARGALA', 0),
(6, 'Green Line', 'DN', 'MARGALA', 'KARACHI CANT', 0),
(7, 'Tezgam', 'UP', 'KARACHI CANT', 'ISLAMABAD ( Madina-Tul-Hajjaj )', 0),
(8, 'Tezgam', 'DN', 'ISLAMABAD ( Madina-Tul-Hajjaj )', 'KARACHI CANT', 0),
(9, 'Allama Iqbal Express', 'UP', 'KARACHI CANT', 'SIALKOT JN', 0),
(10, 'Allama Iqbal Express', 'DN', 'SIALKOT JN', 'KARACHI CITY', 0),
(11, 'Hazara Express', 'UP', 'KARACHI CITY', 'HAVELIAN', 0),
(12, 'Hazara Express', 'DN', 'HAVELIAN', 'KARACHI CITY', 0),
(13, 'Awam Express', 'UP', 'KARACHI CANT', 'PESHAWAR CANT', 0),
(14, 'Awam Express', 'DN', 'PESHAWAR CANT', 'KARACHI CANT', 0),
(15, 'Karachi Express', 'UP', 'KARACHI CANT', 'LAHORE JN', 0),
(16, 'Karachi Express', 'DN', 'LAHORE JN', 'KARACHI CANT', 0),
(17, 'Millat Express', 'UP', 'SARGODHA - FAISALABAD', 'KARACHI CANT', 0),
(18, 'Millat Express', 'DN', 'KARACHI CANT', 'SARGODHA - FAISALABAD', 0),
(19, 'Khushhal Khan Khattak Express', 'UP', 'KARACHI CITY', 'PESHAWAR CANT', 0),
(20, 'Khushhal Khan Khattak Express', 'DN', 'PESHAWAR CANT', 'KARACHI CITY', 0),
(23, 'Akbar Express via  FSLD', 'UP', 'QUETTA', 'LAHORE', 0),
(24, 'Akbar Express via  FSLD', 'DN', 'LAHORE', 'QUETTA', 0),
(25, 'Bahauddin Zakria Express', 'UP', 'KARACHI CITY', 'MULTAN CANT', 0),
(26, 'Bahauddin Zakria Express', 'DN', 'MULTAN CANT', 'KARACHI CITY', 0),
(27, 'Shalimar Express', 'UP', 'KARACHI CANT', 'LAHORE JN', 0),
(28, 'Shalimar Express', 'DN', 'LAHORE JN', 'KARACHI CANT', 0),
(37, 'Fareed Express (Via Pakpattan)', 'UP', 'KARACHI CITY', 'LAHORE JN', 0),
(38, 'Fareed Express (Via Pakpattan)', 'DN', 'LAHORE JN', 'KARACHI CITY', 0),
(39, 'Jaffar Express', 'UP', 'RAWALPINDI', 'QUETTA', 0),
(40, 'Jaffar Express', 'DN', 'QUETTA', 'RAWALPINDI', 0),
(41, 'Karakoram Express', 'UP', 'KARACHI CANT', 'LAHORE JN', 0),
(42, 'Karakoram Express', 'DN', 'LAHORE JN', 'KARACHI CANT', 0),
(43, 'Night Coach (Via Faisalabad)', 'UP', 'KARACHI CANT', 'LAHORE JN', 0),
(44, 'Night Coach (Via Faisalabad)', 'DN', 'LAHORE JN', 'KARACHI CANT', 0),
(45, 'Pakistan Express', 'UP', 'KARACHI CANT', 'RAWALPINDI', 0),
(46, 'Pakistan Express', 'DN', 'RAWALPINDI', 'KARACHI CANT', 0),
(101, 'Subak Raftar', 'UP', 'LAHORE JN', 'RAWALPINDI', 0),
(102, 'Subak Raftar', 'DN', 'RAWALPINDI', 'LAHORE JN', 0),
(103, 'Subak Khram Express', 'UP', 'LAHORE JN', 'RAWALPINDI', 0),
(104, 'Subak Khram Express', 'DN', 'RAWALPINDI', 'LAHORE JN', 0),
(105, 'Rawal Express', 'UP', 'LAHORE JN', 'RAWALPINDI', 0),
(106, 'Rawal Express', 'DN', 'RAWALPINDI', 'LAHORE JN', 0),
(107, 'Islamabad Express', 'UP', 'LAHORE CANT', 'RAWALPINDI', 0),
(108, 'Islamabad Express', 'DN', 'RAWALPINDI', 'LAHORE CANT', 0),
(111, 'Badar Express', 'UP', 'LAHORE JN', 'FAISALABAD - SHORKOT CANT JN', 0),
(112, 'Badar Express', 'DN', 'FAISALABAD SHORKOT CANT JN', 'LAHORE JN', 0),
(113, 'Ghouri  Express', 'UP', 'LAHORE JN', 'FAISALABAD', 0),
(114, 'Ghouri  Express', 'DN', 'FAISALABAD', 'LAHORE JN', 0),
(115, 'Musa Pak Express', 'UP', 'MULTAN CANT', 'LAHORE JN', 0),
(116, 'Musa Pak Express', 'DN', 'LAHORE JN', 'MULTAN CANT', 0),
(121, 'Ravi Express', 'UP', 'SHORKOT CANT. JN', 'LAHORE JN', 0),
(122, 'Ravi Express', 'DN', 'LAHORE JN', 'SHORKOT CANT. JN', 0),
(123, 'Sargodha Express', 'UP', 'LAHORE JN', 'SARGODHA JN', 0),
(124, 'Sargodha Express', 'DN', 'SARGODHA JN', 'LAHORE JN', 0),
(125, 'Lasani Express', 'UP', 'LAHORE JN', 'SIALKOT JN', 0),
(126, 'Lasani Express', 'DN', 'SIALKOT JN', 'LAHORE JN', 0),
(127, 'Mehr Express', 'UP', 'MULTAN CANT', 'RAWALPINDI', 0),
(128, 'Mehr Express', 'DN', 'RAWALPINDI', 'MULTAN CANT', 0),
(135, 'Chenab Express', 'UP', 'SARGODHA JN', 'LALAMUSA JN', 0),
(136, 'Chenab Express', 'DN', 'LALA MUSA JN', 'SARGODHA JN', 0),
(137, 'Lala Musa Express', 'UP', 'SARGODHA JN', 'LALAMUSA JN', 0),
(138, 'Lala Musa Express', 'DN', 'LALAMUSA JN', 'SARGODHA JN', 0),
(139, 'Sandal Express', 'UP', 'MULTAN CANT', 'SARGODHA JN', 0),
(140, 'Sandal Express', 'DN', 'SARGODHA JN', 'MULTAN CANT', 0),
(145, 'Sukkur Express', 'UP', 'KARACHI CANT', 'JACOBABAD JN', 0),
(146, 'Sukkur Express', 'DN', 'JACOBABAD JN', 'KARACHI CANT', 0),
(149, 'Mehran Express', 'UP', 'KARACHI CITY', 'MIRPUR KHAS', 0),
(150, 'Mehran Express', 'DN', 'MIRPUR KHAS', 'KARACHI CITY', 0),
(155, 'Saman Sarkar Express', 'UP', 'HYDERABAD JN', 'MIRPUR KHAS', 0),
(156, 'Saman Sarkar Express', 'DN', 'MIRPUR KHAS', 'HYDERABAD JN', 0),
(179, 'Badin Express', 'UP', 'BADIN', 'KOTRI JN', 0),
(180, 'Badin Express', 'DN', 'KOTRI JN', 'BADIN', 0),
(201, 'Attock Passenger', 'UP', 'MARI INDUS', 'ATTOCK CITY', 0),
(202, 'Attock Passenger', 'DN', 'ATTOCK CITY', 'MARI INDUS', 0),
(203, 'Jand Passenger', 'UP', 'JAND', 'ATTOCK CITY', 0),
(204, 'Jand Passenger', 'DN', 'ATTOCK CITY', 'JAND', 0),
(205, 'Babu Passenger', 'UP', 'LAHORE JN', 'SIALKOT JN', 0),
(206, 'Babu Passenger', 'DN', 'SIALKOT JN', 'LAHORE JN', 0),
(207, 'Waris Shah Fast', 'UP', 'LAHORE JN', 'SHORKOT CANT. JN', 0),
(208, 'Waris Shah Fast', 'DN', 'SHORKOT CANT. JN', 'LAHORE JN', 0),
(209, 'Faiz Ahmed Faiz Passenger', 'UP', 'LAHORE JN', 'NAROWAL JN', 0),
(210, 'Faiz Ahmed Faiz Passenger', 'DN', 'NAROWAL JN', 'LAHORE JN', 0),
(225, 'Shaheen Passenger', 'UP', 'WAZIRABAD JN', 'SIALKOT JN', 0),
(226, 'Shaheen Passenger', 'DN', 'SIALKOT JN', 'WAZIRABAD JN', 0),
(267, 'Rawalpindi Passenger', 'UP', 'RAWALPINDI', 'HAVELIAN', 0),
(268, 'Rawalpindi Passenger', 'DN', 'HAVELIAN', 'RAWALPINDI', 0),
(303, 'Pak Business Express', 'UP', 'KARACHI CITY', 'LAHORE  JN', 0),
(304, 'Pak Business Express', 'DN', 'LAHORE JN', 'KARACHI CITY', 0),
(335, 'Marvi Passenger', 'UP', 'MIRPUR KHAS', 'KHOKHROPAR', 0),
(336, 'Marvi Passenger', 'DN', 'KHOKHROPAR', 'MIRPUR KHAS', 0),
(349, 'Chaman Mixed', 'UP', 'QUETTA', 'CHAMAN', 0),
(350, 'Chaman Mixed', 'DN', 'CHAMAN', 'QUETTA', 0),
(353, 'Passenger', 'UP', 'SARGODHA JN', 'LALA MUSA JN', 0),
(354, 'Passenger', 'DN', 'LALA MUSA JN', 'SARGODHA JN', 0),
(357, 'PDK Shuttle', 'UP', 'MALAKWAL', 'PIND DADAN KHAN', 0),
(358, 'PDK Shuttle', 'DN', 'PIND DADAN KHAN', 'MALAKWAL', 0),
(359, 'PDK Shuttle', 'UP', 'MALAKWAL', 'PIND DADAN KHAN', 0),
(360, 'PDK Shuttle', 'DN', 'PIND DADAN KHAN', 'MALAKWAL', 0),
(401, 'Samjhota Express   ( Every Monday & Thursday )', 'UP', 'WAGAH', 'LAHORE JN', 0),
(402, 'Samjhota Express ( Every Monday & Thursday )', 'DN', 'LAHORE JN', 'WAGAH', 0),
(403, 'Zahidan Mixed Passenger', 'UP', 'QUETTA', 'ZAHIDAN', 0),
(404, 'Zahidan Mixed Passenger', 'DN', 'ZAHIDAN', 'QUETTA', 0),
(405, 'Thar Express', 'UP', 'MIRPUR KHAS', 'KHOKHROPAR', 0),
(406, 'Thar Express', 'DN', 'KHOKHROPAR', 'MIRPUR KHAS', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pr_traindir`
--
ALTER TABLE `pr_traindir`
  ADD PRIMARY KEY (`train_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
