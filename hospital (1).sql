-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 03:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`id`, `name`, `username`, `password`) VALUES
(1, 'Shuraih', 'shuree', 'shirya99');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `fullname` varchar(220) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `passwords` varchar(20) DEFAULT NULL,
  `images` varchar(250) DEFAULT NULL,
  `rank` varchar(15) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `fullname`, `username`, `passwords`, `images`, `rank`, `department`, `gender`, `address`) VALUES
(18, 'my love', 'wqddwxdx', '123', '64346487de7ce.jpg', 'rankkllkkk', 'department', '', ''),
(22, 'admin@webdamn.com', 'aa', '123', 'ACL Nasarawa State Logo.png', 'xdxdw', 'dxcxdd', '', ''),
(25, 'Dr. Uguda', 'Uguda', '1234', 'img-20220516-wa0060.jpg', 'Manager', 'Optician', '', ''),
(26, 'Ugi1', 'ugu11', '123', 'camscanner-03-28-2023-10.55-1.jpg', 'Manager', 'Optician', '', ''),
(27, 'ACD028', 'shuraihusman@gmail.c', '1234', '643092d92d9de.jpg', 'Manager', 'Optician', '', ''),
(28, 'Shuraihu Usman', 'aqw1q', '123', '64330f05d553b.jpg', 'Manager', 'Gynoclical', 'Female', '                      '),
(34, 'Yahaya Musa', 'Yahaya02', '123456789', '6480b7fc91c63.png', 'Manager', 'Dentist', 'Male', 'Jibrin Bawa Street                      ');

-- --------------------------------------------------------

--
-- Table structure for table `patience`
--

CREATE TABLE `patience` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `middlename` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `images` varchar(50) DEFAULT NULL,
  `addresss` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patience`
--

INSERT INTO `patience` (`id`, `firstname`, `surname`, `middlename`, `gender`, `images`, `addresss`) VALUES
(1, 'Taskar Novels', 'sssss', 'dddddddddd', 'Female', '64347e9de457b.jpg', '                                   sksosopspo     textarea    '),
(2, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532808c77c.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(3, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '6435329f16bf9.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(4, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532a18b8b6.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(5, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532a2dbcc1.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(6, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532a42de19.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(7, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532a624e8a.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(8, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532bc54b3f.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(9, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532bd6e10e.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(10, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532be8b111.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(11, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532bf7892b.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(13, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c11546b.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(14, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c1de519.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(15, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c295eef.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(16, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c3414d7.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(17, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c3e3de9.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(18, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c49a433.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(19, 'Yahaya', 'Usman', 'Abdulaziz', 'Male', '643532c549a7b.jpg', 'Jibrin Bawa street, Tsohonkasuwa keffi Nasarawa state'),
(20, 'Musa ', 'Tanimu', 'Dan Sauka', 'Male', '643c609b74637.jpg', '                                                      Jibrin Bawa street            '),
(22, 'Shuraihu', 'Tanimu223', 'dddddddddd', 'Male', '647f5385a8235.jpg', 'Jibrin Bawa street'),
(23, 'Shuraihu', 'Tanimu223', 'dddddddddd', 'Male', '647f53ef38222.jpg', 'Jibrin Bawa street'),
(24, 'Shuraihu', 'Tanimu223', 'dddddddddd', NULL, '647f53f4e69e2.jpg', '                                    Jibrin Bawa street        '),
(25, 'Shuraihu', 'Usman', 'dddddddddd', 'Male', '64e24fca65ccd.jpg', 'Jibrin Bawa street'),
(26, 'Shuraihu', 'Usman', 'sssss', NULL, '656bc1438f9a9.png', '                  Jibrin Bawa street    ');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `sickness` varchar(220) DEFAULT NULL,
  `drug` varchar(50) DEFAULT NULL,
  `descriptions` varchar(200) DEFAULT NULL,
  `images` varchar(50) DEFAULT NULL,
  `pt_id` int(11) NOT NULL,
  `fullname` varchar(222) NOT NULL,
  `dates` datetime NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `sickness`, `drug`, `descriptions`, `images`, `pt_id`, `fullname`, `dates`, `d_id`) VALUES
(1, 'Maleria', '1. text 1', ' ', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-11 00:00:00', 0),
(2, 'Maleria', '1. text 1', ' skslkslkslkslkslkskl', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-11 00:00:00', 0),
(3, 'Maleria', '1. text 1', ' ', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-11 00:00:00', 0),
(4, 'Maleria', '1. text 1', ' dqwdwd', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-11 00:00:00', 0),
(5, 'Maleria', '1. text 1', ' xxx', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-15 00:00:00', 0),
(6, 'Maleria', '1. text 1', ' xxx', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-15 00:00:00', 0),
(7, 'Maleria', '1. text 1', ' hhhjjhjjkkjkllk', '643532808c77c.jpg', 2, 'Yahaya Usman', '2023-04-15 00:00:00', 0),
(8, 'Typoid', 'Na bargu', ' Zaka sha maganin da safe da rana da daddare', '643532c549a7b.jpg', 19, 'Yahaya Usman', '2023-04-15 00:00:00', 0),
(9, 'Maleria sabo', 'Na bargu', ' sq;s;', '643532c549a7b.jpg', 19, 'Yahaya Usman', '2023-04-15 00:00:00', 1),
(13, '', '', ' ', '647f53f4e69e2.jpg', 24, 'Shuraihu Tanimu223', '2023-06-06 00:00:00', 25),
(14, '', '', ' ', '647f53f4e69e2.jpg', 24, 'Shuraihu Tanimu223', '2023-06-06 00:00:00', 25),
(15, 'Maleria', 'Anti Malria', ' zsxcsa', '64e24fca65ccd.jpg', 25, 'Shuraihu Usman', '2023-08-20 19:40:54', 1),
(16, 'Typoid', 'Anti Malria', ' sss', '64e24fca65ccd.jpg', 25, 'Shuraihu Usman', '2023-08-20 19:41:01', 1),
(17, 'Maleria', 'Anti Malria', '3 Mil daily', '656bc1438f9a9.png', 26, 'Shuraihu Usman', '2023-12-03 00:45:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `patience`
--
ALTER TABLE `patience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `patience`
--
ALTER TABLE `patience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
