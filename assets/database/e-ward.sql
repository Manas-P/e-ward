-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 08:05 PM
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
-- Table structure for table `tbl_edu_bg`
--

CREATE TABLE `tbl_edu_bg` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `hs` varchar(200) NOT NULL DEFAULT '0',
  `hss` varchar(200) NOT NULL DEFAULT '0',
  `diploma` varchar(200) NOT NULL DEFAULT '0',
  `ug` varchar(200) NOT NULL DEFAULT '0',
  `pg` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_edu_bg`
--

INSERT INTO `tbl_edu_bg` (`id`, `userid`, `hs`, `hss`, `diploma`, `ug`, `pg`) VALUES
(1, 2230, '../documents/16452101445..pdf', '0', '../documents/16452101077..pdf', '0', '0'),
(2, 2232, '0', '0', '0', '0', '0'),
(5, 2233, '0', '0', '0', '0', '0'),
(7, 2234, '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_house`
--

CREATE TABLE `tbl_house` (
  `hid` int(10) NOT NULL,
  `house_name` varchar(100) NOT NULL,
  `house_no` int(10) NOT NULL,
  `ward_no` int(10) NOT NULL,
  `locality` varchar(100) NOT NULL,
  `post_office` varchar(100) NOT NULL,
  `ration_no` bigint(12) NOT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_house`
--

INSERT INTO `tbl_house` (`hid`, `house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`) VALUES
(1, 'qweew', 121, 2, 'qweqw', 'qwqeweq', 4879856854, 'APL'),
(2, 'Pachakkil House', 145, 2, 'Kottooli', 'Kuthiravattom P.O.', 9568784568, 'APL'),
(3, 'Paramthottu', 154, 2, 'Pala', 'Chengalam', 1256325879, 'APL'),
(4, 'qwer', 124, 2, 'hjhyg', 'ikjjhy', 9865874585, 'APL'),
(6, 'qwert', 15, 2, 'fcrdrdcrd', 'wsxedxed', 8569857458, 'APL'),
(7, 'abcd villa', 5, 2, 'abcdefgh', 'abcdefgh', 4565434567, 'APL'),
(17, 'New housee', 34, 2, 'New locality', 'New post office', 5685458745, 'APL'),
(18, 'new reg ho', 18, 2, 'new', 'new', 8459658745, 'APL'),
(19, 'Kunni House', 23, 2, 'Miami, Street 23', 'Miami PO', 2154785632, 'APL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_house_member`
--

CREATE TABLE `tbl_house_member` (
  `hm_id` int(10) NOT NULL,
  `ward_no` int(10) NOT NULL,
  `house_no` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT 'Not entered',
  `phno` bigint(13) NOT NULL,
  `blood_grp` varchar(5) NOT NULL DEFAULT 'NA',
  `dob` date NOT NULL,
  `photo` varchar(100) NOT NULL DEFAULT '../images/user-profile-placeholder.png',
  `userid` int(50) NOT NULL DEFAULT 0,
  `password` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_house_member`
--

INSERT INTO `tbl_house_member` (`hm_id`, `ward_no`, `house_no`, `fname`, `email`, `phno`, `blood_grp`, `dob`, `photo`, `userid`, `password`) VALUES
(1, 2, 145, 'Annette Black', 'Not entered', 9658784526, 'O+', '1998-06-23', '../images/uploads/photos/1638009888.png', 0, ''),
(2, 2, 145, 'James Black', 'jamesblack@gmail.com', 9856587452, 'O+', '1995-03-15', '../images/uploads/photos/1638009946.png', 0, ''),
(3, 2, 154, 'Frank', 'fank@gmail.com', 9854569844, 'B-', '1998-09-17', '../images/uploads/photos/1638860482.jpg', 0, ''),
(4, 2, 154, 'Celia', 'celia@gmail.com', 9856587459, 'B-', '2001-10-01', '../images/uploads/photos/1638860567.png', 0, ''),
(5, 2, 145, 'Manas P', 'manas4518pachakkil@gmail.com', 9856587855, 'O+', '1998-10-28', '../images/uploads/photos/1639161827.png', 0, ''),
(15, 2, 34, 'new test', 'Not entered', 9858356478, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2340, '123'),
(16, 2, 18, 'new reg', 'Not entered', 5458965879, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2180, '123'),
(17, 2, 18, 'new regg', 'new@gmail.com', 9856587459, 'O+', '2019-07-10', '../images/uploads/photos/1643969508.png', 0, '0'),
(23, 2, 34, 'New new test', 'newnewtest@gmail.com', 9565878456, 'A+', '2000-01-05', '../images/uploads/photos/1644173899.png', 2342, '123'),
(24, 2, 34, 'new newe', 'new@gmail.com', 8965236589, 'A+', '2016-02-10', '../images/uploads/photos/1644286381.png', 2343, '123'),
(25, 2, 34, 'new nneww', 'new@gmail.com', 9565215487, 'A+', '2014-02-18', '../images/uploads/photos/1644592133.png', 2344, 'NdyprVQa'),
(26, 2, 23, 'Rubin Siby', 'Not entered', 9565878452, 'B+', '1988-06-15', '../images/uploads/photos/1644834244.png', 2230, '123'),
(27, 2, 24, 'Martin Garrix', 'Not entered', 9565878457, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2240, 'eer5XjwS'),
(28, 2, 23, 'Kunnus', 'martingrrx@gmail.com', 9856547854, 'B+', '2002-05-15', '../images/uploads/photos/1644839475.jpg', 2232, '123'),
(29, 2, 23, 'Jacob Kurien', 'jacobkurien@gmail.com', 9856587457, 'O+', '1999-11-03', '../images/uploads/photos/1644838551.jpg', 2233, '123'),
(30, 2, 23, 'Appy Kurian', 'kuriappy@gmail.com', 9565874521, 'A+', '1999-06-15', '../images/uploads/photos/1645185833.jpeg', 2234, '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_id_proof`
--

CREATE TABLE `tbl_id_proof` (
  `id` int(10) NOT NULL,
  `userid` int(50) NOT NULL,
  `aadhar_no` bigint(100) NOT NULL DEFAULT 0,
  `aadhar_file` varchar(200) NOT NULL DEFAULT '0',
  `election_id` bigint(50) NOT NULL DEFAULT 0,
  `election_id_file` varchar(200) NOT NULL DEFAULT '0',
  `driving_lic` varchar(100) NOT NULL DEFAULT '0',
  `driving_lic_file` varchar(200) NOT NULL DEFAULT '0',
  `pan_card` varchar(100) NOT NULL DEFAULT '0',
  `pan_card_file` varchar(200) NOT NULL DEFAULT '0',
  `birth_cer` bigint(50) NOT NULL DEFAULT 0,
  `birth_cer_file` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_id_proof`
--

INSERT INTO `tbl_id_proof` (`id`, `userid`, `aadhar_no`, `aadhar_file`, `election_id`, `election_id_file`, `driving_lic`, `driving_lic_file`, `pan_card`, `pan_card_file`, `birth_cer`, `birth_cer_file`) VALUES
(1, 2344, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(2, 2230, 1, '../documents/1644947316..pdf', 2, '../documents/16449473161..pdf', '3', '../documents/16449473162..pdf', '4', '../documents/16449473163..pdf', 5, '../documents/16449473164..pdf'),
(3, 2240, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(4, 2232, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(5, 2233, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(6, 2234, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pro_bg`
--

CREATE TABLE `tbl_pro_bg` (
  `id` int(10) NOT NULL,
  `userid` int(100) NOT NULL,
  `cur_pro` varchar(200) NOT NULL DEFAULT '0',
  `cur_pro_file` varchar(200) NOT NULL DEFAULT '0',
  `comp_name` varchar(200) NOT NULL DEFAULT '0',
  `location` varchar(200) NOT NULL DEFAULT '0',
  `pro_started` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pro_bg`
--

INSERT INTO `tbl_pro_bg` (`id`, `userid`, `cur_pro`, `cur_pro_file`, `comp_name`, `location`, `pro_started`) VALUES
(1, 2230, 'Software engineer', '../documents/164529716910..pdf', 'Cognizant', 'Bangalore', '2021-12-16'),
(2, 2232, 'Software developer', '0', 'TCS', 'Red street', '0000-00-00');

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
  `taxreport` varchar(200) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`rid`, `fname`, `email`, `phno`, `wardno`, `houseno`, `taxreport`, `status`) VALUES
(1, 'Manas', 'manas@gmail.com', 9446184518, 15, 125, '2458696351', 1),
(2, 'mudhiu', 'manas@gmail.com', 4512365987, 25, 214, '5369874512', 0),
(3, 'asd', 'asd@gmail.com', 4125632569, 15, 125, '5236598744', 0),
(4, 'Man', 'man@gmail.com', 1234567898, 12, 145, '1254589632', 0),
(5, 'qwe', 'qwe@gmail.com', 4125632587, 45, 236, '1254587452', 0),
(6, 'telbincherian', 'ctelbin@gmail.com', 9605020907, 12, 124, '7894561211', 0),
(7, 'qw', 'qw@gmail.com', 1254125632, 14, 137, '1256587856', 0),
(8, 'qw', 'qw@gmail.com', 45125632547, 41, 47, '4589632321', 0),
(9, 'Appy Kurian', 'kuriantom@mca.ajce.in', 9548751256, 14, 123, '1254896325', 1),
(10, 'Amal Joy', 'amaljoy@mca.ajce.in', 8569878542, 14, 21, '1254589658', 1),
(11, 'Akshai Biju', 'akshaibiju@mca.ajce.in', 4589652365, 17, 11, '1214526987', 1),
(12, 'Kunni Bhai', 'telbincherian@mca.ajce.in', 7845698541, 12, 965, '1458978745', 1),
(13, 'Ebin Johnson', 'ebinjohnson@mca.ajce', 8545896587, 54, 456, '9458965412', 1),
(14, 'Anali Jose', 'josekemerson@mca.ajce.in', 9865487854, 14, 23, '1254897785', 1),
(15, 'Kozhi Sanju', 'sanjuabrahambinu@mca.ajce.in', 9548785468, 14, 234, '1254896587', 1),
(16, 'Katta', 'akshaibiju3@gmail.com', 58965236587, 3, 14, '1254895632', 1),
(17, 'Anumol', 'anualexander@mca.ajce.in', 9565874587, 14, 128, '2548965236', 1),
(18, 'aa', 'aa@gmail.com', 9854887541, 2, 121, '4879856854', 1),
(19, 'Akshai', 'akshaibiju@mca.ajce.in', 9856587458, 8, 12, '8754521254', 1),
(20, 'Manas P', 'manas4513pachakkil@gmail.com', 9446184518, 2, 145, '9568784568', 1),
(21, 'Telbin Cherian', 'telbincherian@gmail.com', 9565878451, 2, 124, '9865874585', 1),
(22, 'Kurian Tom', 'kuriantom2017@gmail.com', 9856587458, 2, 12, '6587845213', 1),
(25, 'Maamachan', 'albinpthomas@mca.ajce.in', 9856547854, 2, 158, '6589856587', 0),
(27, 'Frank Thomas', 'frankmathewsthomas@mca.ajce.in', 9856548785, 2, 154, '1256325879', 1),
(28, 'laali', 'laali@ed.fvv', 8785698745, 2, 147, '1523658795', 0),
(29, 'Laali Bhaai', 'laa@gmz.ff', 5485478965, 2, 14, '1523659875', 0),
(31, 'aaa', 'aaa@gmail.com', 9547586965, 2, 15, '8569857458', 1),
(35, 'test', 'test@gmail.com', 5478965256, 2, 143, '1258963254', 1),
(38, 'test', 'test@gmail.com', 5456765679, 2, 56, '../documents/taxreport/1643748995.pdf', 1),
(39, 'test', 'test@gmail.com', 5467543345, 2, 5, '../documents/taxreport/1643751741.pdf', 1),
(40, 'Manas test', 'manasp@mca.ajce.in', 7678976780, 2, 4, '../documents/taxreport/1643752792.pdf', 1),
(42, 'new test', 'newtest@gmail.com', 9858356478, 2, 34, '../documents/taxreport/1643837559.pdf', 1),
(43, 'new reg', 'newreg@gmail.com', 5458965879, 2, 18, '../documents/taxreport/1643969173.pdf', 1),
(44, 'David Guetta', 'davidguetta@gmail.com', 9565878452, 2, 23, '../documents/taxreport/1644592357.pdf', 1),
(45, 'Martin Garrix', 'martingrx@gmail.com', 9565878457, 2, 24, '../documents/taxreport/1644593477.pdf', 1),
(46, 'dont accept', 'sont@gmail.com', 9565878454, 2, 78, '../documents/taxreport/1644595851.pdf', 0),
(47, 'kunnuz', 'kunnu@gmail.com', 9565874587, 2, 48, '../documents/taxreport/1644849229.pdf', 0);

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
(1, 'Wade Warren', 'wade@gmail.com', 9854875632, 1, '2025-03-19', '../images/uploads/photos/1637689913.png', 0, 1, 'vebnoDxw'),
(2, 'Manas P', 'manas4518pachakkil@gmail.com', 9446184519, 2, '2025-03-19', '../images/uploads/photos/1637437831.png', 0, 1, '123'),
(3, 'Annette Black', 'annette@gmail.com', 9845587455, 3, '2025-03-19', '../images/uploads/photos/1637438042.png', 0, 1, 'WMRwL7Zm'),
(4, 'Marvin McKinney', 'marvin@gmail.com', 9865478524, 4, '2025-03-19', '../images/uploads/photos/1637438149.png', 0, 1, 'Yl6Xxf2p'),
(5, 'Savannah Nguyen', 'savannah@gmail.com', 7458965237, 5, '2025-03-19', '../images/uploads/photos/1637438202.png', 0, 1, 'UNmwfQ4j'),
(6, 'Kurian Tom', 'kuriantom@mca.ajce.in', 9856547854, 6, '2025-03-19', '../images/uploads/photos/1637516935.jpeg', 0, 1, 'ILMxnMgV'),
(7, 'Telbin Cherian', 'telbincherian@mca.ajce.in', 9856587745, 7, '2025-03-19', '../images/uploads/photos/1637517031.jpg', 0, 1, 'laEQbXxJ'),
(8, 'Vinu Reji John', 'vinurejijohn21@gmail.com', 9856687458, 8, '2025-03-19', '../images/uploads/photos/1637659458.jpg', 0, 1, 'AyNAxXRD'),
(9, 'Mrudul A', 'ganjan@gmail.com', 9565874587, 9, '2025-03-19', '../images/uploads/photos/1637837216.png', 0, 1, 'Bxs3FNtl'),
(10, 'James George', 'jamesgeorge@gmail.com', 9568784523, 10, '2025-03-19', '../images/uploads/photos/1638012009.png', 0, 1, 'l6lrouag');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `tbl_edu_bg`
--
ALTER TABLE `tbl_edu_bg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_house`
--
ALTER TABLE `tbl_house`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `tbl_house_member`
--
ALTER TABLE `tbl_house_member`
  ADD PRIMARY KEY (`hm_id`);

--
-- Indexes for table `tbl_id_proof`
--
ALTER TABLE `tbl_id_proof`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pro_bg`
--
ALTER TABLE `tbl_pro_bg`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tbl_edu_bg`
--
ALTER TABLE `tbl_edu_bg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_house`
--
ALTER TABLE `tbl_house`
  MODIFY `hid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_house_member`
--
ALTER TABLE `tbl_house_member`
  MODIFY `hm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_id_proof`
--
ALTER TABLE `tbl_id_proof`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pro_bg`
--
ALTER TABLE `tbl_pro_bg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_ward_member`
--
ALTER TABLE `tbl_ward_member`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
