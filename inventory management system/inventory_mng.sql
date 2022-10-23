-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 01:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_mng`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_info`
--

CREATE TABLE `ad_info` (
  `name` varchar(20) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ad_info`
--

INSERT INTO `ad_info` (`name`, `mail`, `password`) VALUES
('Fatema', 'fatema@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `proName` varchar(20) NOT NULL,
  `proDes` text DEFAULT NULL,
  `unt` varchar(20) NOT NULL,
  `untPrice` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`proName`, `proDes`, `unt`, `untPrice`) VALUES
('Coconut Oil', '', 'Litre', 110),
('color pencil', 'blue', 'Number', 110),
('Cotton Fabric', '', 'Metre', 80),
('Salt', '', 'Kg', 20),
('Sugar', '', 'Kg', 75);

-- --------------------------------------------------------

--
-- Table structure for table `purch`
--

CREATE TABLE `purch` (
  `date` date NOT NULL,
  `proName` varchar(20) NOT NULL,
  `unt` varchar(20) NOT NULL,
  `untPrice` int(30) NOT NULL,
  `quantity` int(20) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purch`
--

INSERT INTO `purch` (`date`, `proName`, `unt`, `untPrice`, `quantity`, `total`) VALUES
('2022-05-13', 'pen', 'Number', 20, 10, 200),
('2022-05-02', 'pen', 'Number', 10, 20, 200),
('2022-05-04', 'pencil', 'Number', 6, 20, 120),
('2022-05-03', 'salt', 'Kg', 12, 10, 120),
('2022-05-01', 'Salt', 'Kg', 30, 100, 3000),
('2022-05-01', 'Coconut Oil', 'Litre', 100, 100, 10000),
('2022-05-01', 'color pencil', 'Number', 200, 100, 20000),
('2022-05-01', 'Salt', 'Kg', 20, 10, 200);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `date` date NOT NULL,
  `proName` varchar(20) NOT NULL,
  `unt` varchar(20) NOT NULL,
  `untPrice` int(30) NOT NULL,
  `quantity` int(20) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`date`, `proName`, `unt`, `untPrice`, `quantity`, `total`) VALUES
('2022-05-03', 'pen', 'Number', 20, 20, 400),
('2022-05-10', 'salt', 'Kg', 10, 12, 120),
('2022-05-02', 'Salt', 'Kg', 40, 50, 2000),
('2022-05-19', 'Coconut Oil', 'Litre', 110, 50, 5500),
('2022-05-03', 'color pencil', 'Number', 200, 10, 2000),
('2022-05-04', 'Salt', 'Kg', 25, 20, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_info`
--
ALTER TABLE `ad_info`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`proName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
