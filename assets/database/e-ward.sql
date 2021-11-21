-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 06:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-ward`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adid`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE `tbl_registration` (
  `rid` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phno` bigint(15) NOT NULL,
  `wardno` bigint(10) NOT NULL,
  `houseno` bigint(10) NOT NULL,
  `password` varchar(60) NOT NULL DEFAULT '0',
  `rationno` bigint(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`rid`, `fname`, `email`, `phno`, `wardno`, `houseno`, `password`, `rationno`, `status`) VALUES
(1, 'Manas', 'manas@gmail.com', 9446184518, 15, 125, 'NuYivsek', 2458696351, 1),
(2, 'mudhiu', 'manas@gmail.com', 4512365987, 25, 214, '0', 5369874512, 0),
(3, 'asd', 'asd@gmail.com', 4125632569, 15, 125, '0', 5236598744, 0),
(4, 'Man', 'man@gmail.com', 1234567898, 12, 145, '0', 1254589632, 0),
(5, 'qwe', 'qwe@gmail.com', 4125632587, 45, 236, '0', 1254587452, 0),
(6, 'telbincherian', 'ctelbin@gmail.com', 9605020907, 12, 124, '0', 7894561211, 0),
(7, 'qw', 'qw@gmail.com', 1254125632, 14, 137, '0', 1256587856, 0),
(8, 'qw', 'qw@gmail.com', 45125632547, 41, 47, '0', 4589632321, 0),
(9, 'Appy Kurian', 'kuriantom@mca.ajce.in', 9548751256, 14, 123, '123', 1254896325, 1),
(10, 'Amal Joy', 'amaljoy@mca.ajce.in', 8569878542, 14, 21, 'i3f69EAm', 1254589658, 1),
(11, 'Akshai Biju', 'akshaibiju@mca.ajce.in', 4589652365, 17, 11, 'uj42Ayol', 1214526987, 1),
(12, 'Kunni Bhai', 'telbincherian@mca.ajce.in', 7845698541, 12, 965, 'BmzxyDGj', 1458978745, 1),
(13, 'Ebin Johnson', 'ebinjohnson@mca.ajce', 8545896587, 54, 456, 'GvjBPt3h', 9458965412, 1),
(14, 'Anali Jose', 'josekemerson@mca.ajce.in', 9865487854, 14, 23, '5IE8TctU', 1254897785, 1),
(15, 'Kozhi Sanju', 'sanjuabrahambinu@mca.ajce.in', 9548785468, 14, 234, '77gsp0th', 1254896587, 1),
(16, 'Katta', 'akshaibiju3@gmail.com', 58965236587, 3, 14, '4PjLplOg', 1254895632, 1),
(17, 'Anumol', 'anualexander@mca.ajce.in', 9565874587, 14, 128, 'Vtypy03e', 2548965236, 1),
(18, 'aa', 'aa@gmail.com', 9854887541, 2, 121, '0', 4879856854, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ward_member`
--

CREATE TABLE `tbl_ward_member` (
  `mid` int(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phno` bigint(15) NOT NULL,
  `wardno` int(10) NOT NULL,
  `validupto` date NOT NULL,
  `photo` varchar(200) NOT NULL,
  `president` int(10) NOT NULL DEFAULT 0,
  `status` int(10) NOT NULL DEFAULT 1,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ward_member`
--

INSERT INTO `tbl_ward_member` (`mid`, `fullname`, `email`, `phno`, `wardno`, `validupto`, `photo`, `president`, `status`, `password`) VALUES
(1, 'Wade Warren', 'wade@gmail.com', 9854875632, 1, '2025-06-17', '../images/uploads/photos/1637437604.png', 0, 1, 'vebnoDxw'),
(2, 'Manas P', 'manas4518pachakkil@gmail.com', 9446184519, 2, '2025-06-25', '../images/uploads/photos/1637437831.png', 0, 1, '123'),
(3, 'Annette Black', 'annette@gmail.com', 9845587455, 3, '2025-06-19', '../images/uploads/photos/1637438042.png', 0, 1, 'WMRwL7Zm'),
(4, 'Marvin McKinney', 'marvin@gmail.com', 9865478524, 4, '2024-09-30', '../images/uploads/photos/1637438149.png', 0, 1, 'Yl6Xxf2p'),
(5, 'Savannah Nguyen', 'savannah@gmail.com', 7458965237, 5, '2023-06-26', '../images/uploads/photos/1637438202.png', 0, 1, 'UNmwfQ4j'),
(6, 'Kurian Tom ', 'kuriantom@mca.ajce.in', 9856547854, 6, '2025-03-18', '../images/uploads/photos/1637516935.jpeg', 0, 1, 'ILMxnMgV'),
(7, 'Telbin Cherian', 'telbincherian@mca.ajce.in', 9856587745, 7, '2025-06-18', '../images/uploads/photos/1637517031.jpg', 0, 1, 'laEQbXxJ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_ward_member`
--
ALTER TABLE `tbl_ward_member`
  ADD PRIMARY KEY (`mid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_ward_member`
--
ALTER TABLE `tbl_ward_member`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
