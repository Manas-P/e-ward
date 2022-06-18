-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 08:44 PM
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
(1, 'admin', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_committee`
--

CREATE TABLE `tbl_committee` (
  `id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `wardno` int(10) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_description` varchar(300) NOT NULL,
  `c_photo` varchar(100) NOT NULL,
  `m_limit` int(10) NOT NULL,
  `m_joined` int(10) NOT NULL DEFAULT 0,
  `added_by` varchar(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_committee`
--

INSERT INTO `tbl_committee` (`id`, `c_id`, `wardno`, `c_name`, `c_description`, `c_photo`, `m_limit`, `m_joined`, `added_by`, `status`) VALUES
(1, 2221, 2, 'Covid relief program', 'In the wake of the continuing threat of COVID 19, the Government of Kerala has launched an online education programme for school children. The initiative links teachers and the school children through a series of online sessions accessed from homes, community centres, or libraries, observing.', '../../../public/assets/images/uploads/photos/1654730249.jpg', 25, 0, '2', 1),
(2, 2222, 2, 'Flood relief', 'The state government has constituted a committee to help define the criteria to allocate funds to local bodies for rebuilding post-flood. The government had allocated Rs 250 crore in the 2021-22 budget for rebuilding\r\n', '../../../public/assets/images/uploads/photos/1654729326.jpeg', 25, 2, '2', 1),
(3, 2223, 2, 'Committee long name submitted', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '../../../public/assets/images/uploads/photos/1648653685.jpg', 15, 1, '2', 1),
(4, 2224, 2, 'Flood relief', 'oosdi fosdhf iuhdif uiudhfisuhdf isudhf iushdfishdiufh sduhfishdf isudhfishdhf df.', '../../../public/assets/images/uploads/photos/1652537266.png', 30, 0, '2', 1),
(5, 3331, 3, 'trst new ward', 'uer iuerh ihuer', '../../../public/assets/images/uploads/photos/1652537311.png', 10, 0, '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_committee_member`
--

CREATE TABLE `tbl_committee_member` (
  `id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `h_userid` int(10) NOT NULL,
  `c_userid` int(10) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_committee_member`
--

INSERT INTO `tbl_committee_member` (`id`, `c_id`, `h_userid`, `c_userid`, `password`) VALUES
(1, 2222, 2234, 22221, 'Qwerty@123'),
(5, 2223, 2160, 22231, 'Qwerty@123'),
(6, 2222, 2232, 22222, 'Qwerty@123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_committee_req`
--

CREATE TABLE `tbl_committee_req` (
  `id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `wardno` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_committee_req`
--

INSERT INTO `tbl_committee_req` (`id`, `c_id`, `userid`, `wardno`, `status`) VALUES
(1, 2224, 2160, 2, 0),
(2, 2222, 2162, 2, 2),
(3, 2222, 2234, 2, 1),
(6, 2222, 2232, 2, 1),
(7, 2223, 2160, 2, 1),
(8, 2222, 2230, 2, 0),
(9, 2222, 2233, 2, 0),
(10, 2222, 2235, 2, 0);

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
(7, 2234, '0', '0', '0', '0', '0'),
(8, 2235, '0', '0', '0', '0', '0'),
(9, 2480, '0', '0', '0', '0', '0'),
(10, 2780, '0', '0', '0', '0', '0'),
(11, 2140, '0', '0', '0', '0', '0'),
(12, 21470, '0', '0', '0', '0', '0'),
(13, 21580, '0', '0', '0', '0', '0'),
(14, 230, '0', '0', '0', '0', '0'),
(15, 260, '0', '0', '0', '0', '0'),
(16, 270, '0', '0', '0', '0', '0'),
(17, 290, '0', '0', '0', '0', '0'),
(18, 280, '0', '0', '0', '0', '0'),
(19, 2540, '../documents/16455902175..pdf', '0', '0', '0', '0'),
(20, 2542, '0', '0', '0', '0', '0'),
(21, 2850, '0', '0', '0', '0', '0'),
(22, 2450, '0', '0', '0', '0', '0'),
(23, 2130, '0', '0', '0', '0', '0'),
(24, 2132, '0', '0', '0', '0', '0'),
(25, 2133, '0', '0', '0', '0', '0'),
(26, 2134, '0', '0', '0', '0', '0'),
(27, 2135, '0', '0', '0', '0', '0'),
(28, 2136, '0', '0', '0', '0', '0'),
(29, 2137, '0', '0', '0', '0', '0'),
(30, 2530, '0', '0', '0', '0', '0'),
(31, 2430, '0', '0', '0', '0', '0'),
(32, 2160, '0', '0', '0', '0', '0'),
(33, 2162, '0', '0', '0', '0', '0'),
(34, 2110, '0', '0', '0', '0', '0'),
(35, 2162, '0', '0', '0', '0', '0'),
(36, 2163, '0', '0', '0', '0', '0'),
(37, 2164, '0', '0', '0', '0', '0'),
(38, 21250, '0', '0', '0', '0', '0'),
(39, 21440, '0', '0', '0', '0', '0'),
(40, 2410, '0', '0', '0', '0', '0'),
(41, 2190, '0', '0', '0', '0', '0'),
(42, 21220, '0', '0', '0', '0', '0'),
(43, 21230, '0', '0', '0', '0', '0'),
(44, 21120, '0', '0', '0', '0', '0'),
(45, 21460, '0', '0', '0', '0', '0'),
(46, 310, '0', '0', '0', '0', '0'),
(47, 312, '0', '0', '0', '0', '0'),
(48, 21690, '0', '0', '0', '0', '0'),
(49, 2420, '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_e_doc`
--

CREATE TABLE `tbl_e_doc` (
  `id` int(10) NOT NULL,
  `wardno` int(10) NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_e_doc`
--

INSERT INTO `tbl_e_doc` (`id`, `wardno`, `doc_name`, `file`) VALUES
(1, 2, 'Corporation water request', '../../../public/assets/documents/edocument/1651770052.pdf'),
(2, 2, 'Income certificate application', '../../../public/assets/documents/edocument/1651770077.pdf'),
(3, 2, 'Borewell application', '../../../public/assets/documents/edocument/1651770100.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forgot_password`
--

CREATE TABLE `tbl_forgot_password` (
  `id` int(10) NOT NULL,
  `userid` varchar(100) NOT NULL DEFAULT '0',
  `otp` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `category` varchar(10) NOT NULL,
  `street_light` int(10) NOT NULL DEFAULT 0,
  `street_light_status` int(10) NOT NULL DEFAULT 0,
  `post_no` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_house`
--

INSERT INTO `tbl_house` (`hid`, `house_name`, `house_no`, `ward_no`, `locality`, `post_office`, `ration_no`, `category`, `street_light`, `street_light_status`, `post_no`) VALUES
(2, 'Pachakkil House', 145, 2, 'Kottooli', 'Kuthiravattom P.O.', 9568784568, 'APL', 1, 1, 'C52'),
(17, 'Dream House', 34, 2, 'New locality', 'New post office', 5685458745, 'APL', 0, 0, '0'),
(18, 'New Villa', 18, 2, 'new', 'new', 8459658745, 'APL', 1, 1, 'C10'),
(19, 'Veluthedath House', 23, 2, 'Miami, Street 23, Near beach', 'Miami PO', 2154785632, 'APL', 0, 0, '0'),
(23, 'Dragon House', 16, 2, 'Kottooli', 'new house space', 9545874541, 'APL', 1, 1, 'C12'),
(24, 'Naruto Villa', 1, 3, 'ef wer we', 'wewefw', 2354856214, 'APL', 0, 0, '0'),
(25, 'Sasuke Villa', 146, 2, 'qwe', 'qwe', 2343242434, 'APL', 0, 0, '0');

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
  `photo` varchar(100) NOT NULL DEFAULT '../../../public/assets/images/user-profile-placeholder.png',
  `userid` int(50) NOT NULL DEFAULT 0,
  `password` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_house_member`
--

INSERT INTO `tbl_house_member` (`hm_id`, `ward_no`, `house_no`, `fname`, `email`, `phno`, `blood_grp`, `dob`, `photo`, `userid`, `password`) VALUES
(1, 2, 145, 'Annette Black', 'Not entered', 9658784526, 'O+', '1998-06-23', '../images/uploads/photos/1638009888.png', 0, 'Qwerty@123'),
(2, 2, 145, 'James Black', 'jamesblack@gmail.com', 9856587452, 'O+', '1995-03-15', '../images/uploads/photos/1638009946.png', 0, 'Qwerty@123'),
(5, 2, 145, 'Manas P', 'manas4518pachakkil@gmail.com', 9856587855, 'O+', '1998-10-28', '../images/uploads/photos/1639161827.png', 21450, 'Qwerty@1'),
(15, 2, 34, 'new test', 'Not entered', 9858356478, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2340, '123'),
(16, 2, 18, 'new reg', 'Not entered', 5458965879, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2180, '123'),
(17, 2, 18, 'new regg', 'new@gmail.com', 9856587459, 'O+', '2019-07-10', '../images/uploads/photos/1643969508.png', 0, 'Qwerty@123'),
(23, 2, 34, 'New new test', 'newnewtest@gmail.com', 9565878456, 'A+', '2000-01-05', '../images/uploads/photos/1644173899.png', 2342, '123'),
(24, 2, 34, 'new newe', 'new@gmail.com', 8965236589, 'A+', '2016-02-10', '../images/uploads/photos/1644286381.png', 2343, '123'),
(25, 2, 34, 'new nneww', 'new@gmail.com', 9565215487, 'A+', '2014-02-18', '../images/uploads/photos/1644592133.png', 2344, 'NdyprVQa'),
(26, 2, 23, 'Rubin Siby', 'rubinsibyy@gmail.com', 9565878452, 'B+', '1988-06-15', '../../../public/assets/images/uploads/photos/1654730405.png', 2230, 'Qwerty@123'),
(27, 2, 24, 'Martin Garrix', 'Not entered', 9565878457, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2240, 'eer5XjwS'),
(28, 2, 23, 'Telbin Kurian', 'martingrrx@gmail.com', 9856547854, 'B+', '2002-05-15', '../../../public/assets/images/1650291702.jpg', 2232, 'Qwerty@123'),
(29, 2, 23, 'Jacob Kurien', 'jacob@gmail.com', 9856587457, 'O+', '1999-11-03', '../../../public/assets/images/uploads/photos/1654730455.jpg', 2233, 'Qwerty@123'),
(30, 2, 23, 'Kurian Tom', 'kuriappy@gmail.com', 9565874521, 'A+', '1999-06-15', '../../../public/assets/images/1650291735.jpeg', 2234, 'Qwerty@123'),
(31, 2, 23, 'Martin Garrix', 'martingar@gmail.com', 9856548758, 'O+', '1998-09-29', '../../../public/assets/images/uploads/photos/1654730468.jpg', 2235, 'Qwerty@123'),
(32, 2, 48, 'kunnuz', 'Not entered', 9565874587, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2480, 'WuuzszdT'),
(33, 2, 78, 'dont accept', 'Not entered', 9565878454, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2780, 'phECFulL'),
(34, 2, 14, 'Laali Bhaai', 'Not entered', 5485478965, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2140, 'HLAtR9oS'),
(35, 2, 147, 'laali', 'Not entered', 8785698745, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 21470, '1ltoWqhL'),
(36, 2, 158, 'Maamachan', 'Not entered', 9856547854, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 21580, 'LMQEJjMN'),
(37, 2, 3, 'asd', 'Not entered', 9565451258, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 230, 'SwMVsH8f'),
(38, 2, 6, 'qwe', 'Not entered', 9856587458, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 260, 'dsX4eJ0x'),
(39, 2, 7, 'ert', 'Not entered', 9587845236, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 270, 'GkSmjBDV'),
(40, 2, 9, 'rty', 'Not entered', 9854587845, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 290, 'Rqm6Jt9s'),
(41, 2, 8, 'sdf', 'Not entered', 9856523587, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 280, '38cNmH4f'),
(44, 2, 85, 'fgh', 'Not entered', 9856587845, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2850, '1jnz1SCN'),
(53, 2, 53, 'djkfhg', 'jb@gmail.com', 9854589858, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2530, 'VubsYXvs'),
(54, 2, 43, 'tyutut', 'tyutyu@gmail.com', 9565458785, 'NA', '0000-00-00', '../images/user-profile-placeholder.png', 2430, 'PZyugaZF'),
(55, 2, 16, 'Kurien Tom', 'nwwechk@gmail.com', 9854512547, 'B+', '1994-06-15', '../../../public/assets/images/uploads/photos/1651724017.jpeg', 2160, '123'),
(57, 2, 11, 'Frank', 'frankmathewsthomas@gmail.com', 9875456324, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 2110, 'AuqzvCFx'),
(58, 2, 16, 'Martin Garrix', 'newmember@gmail.com', 9854512548, 'O+', '2014-08-14', '../../../public/assets/images/uploads/photos/1650351067.jpg', 2162, '123'),
(59, 2, 16, 'David Guetta', 'davidguetta@gmail.com', 9856523257, 'A+', '1987-07-02', '../../../public/assets/images/user-profile-placeholder.png', 2163, 'v7g7KEyl'),
(61, 2, 125, 'hjkkh hjk', 'dsfg@gmai.coj', 4523256587, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 21250, 'WVUgxOJL'),
(62, 2, 144, 'chknew', 'chknew@gmail.com', 9854587452, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 21440, 'Ws7PGgJZ'),
(63, 2, 41, 'fghefs', 'fghf@gmail.com', 9856587845, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 2410, 'TYFij8Nh'),
(64, 2, 19, 'tuyu', 'fgh@gmail.com', 9856587845, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 2190, '4S5kyI5B'),
(65, 2, 122, 'chech staff', 'chkstaff@gmail.com', 9854562321, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 21220, 'ekPuSM2T'),
(66, 2, 123, 'chech ward mem', 'chkmem@gmail.com', 9854563210, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 21230, 'he6pi7F9'),
(67, 2, 112, 'tset time', 'tefy@gmail.cm', 9854512547, 'NA', '0000-00-00', '../../../public/assets/images/user-profile-placeholder.png', 21120, 'sViKI0jh');

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
(6, 2234, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(7, 2235, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(8, 2480, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(9, 2780, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(10, 2140, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(11, 21470, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(12, 21580, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(13, 230, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(14, 260, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(15, 270, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(16, 290, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(17, 280, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(18, 2540, 2325658784, '../documents/16455902170..pdf', 0, '0', '0', '0', '0', '0', 0, '0'),
(19, 2542, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(20, 2850, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(21, 2450, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(22, 2130, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(23, 2132, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(24, 2133, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(25, 2134, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(26, 2135, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(27, 2136, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(28, 2137, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(29, 2530, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(30, 2430, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(31, 2160, 9874512145, '../../../public/assets/documents/16481377510..pdf', 0, '0', '0', '0', '0', '0', 0, '0'),
(32, 2162, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(33, 2110, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(34, 2162, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(35, 2163, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(36, 2164, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(37, 21250, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(38, 21440, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(39, 2410, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(40, 2190, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(41, 21220, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(42, 21230, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(43, 21120, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(44, 21460, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(45, 310, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(46, 312, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(47, 21690, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0'),
(48, 2420, 0, '0', 0, '0', '0', '0', '0', '0', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_need_request`
--

CREATE TABLE `tbl_need_request` (
  `id` int(10) NOT NULL,
  `wardno` int(10) NOT NULL,
  `houseno` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `proof_file` varchar(100) NOT NULL DEFAULT '0',
  `office_staff` varchar(100) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT 0,
  `reply` varchar(1000) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_need_request`
--

INSERT INTO `tbl_need_request` (`id`, `wardno`, `houseno`, `userid`, `description`, `proof_file`, `office_staff`, `status`, `reply`) VALUES
(1, 2, 16, 2160, 'Road gutter has increased', '../../../public/assets/documents/request/1651536548.pdf', 'Wade Warren', 1, '0'),
(3, 2, 16, 2162, 'Testing the need request', '../../../public/assets/documents/request/1651536987.pdf', 'Wade Warren', 3, 'Invalid information, please re-apply with valid information.'),
(4, 2, 16, 2160, 'Need a Laptop for higher education', '0', 'Wade Warren', 2, 'Your request have approved, we will take necessary action on 3rd june'),
(5, 2, 16, 2160, 'This is a new need request added by a house member', '0', 'Kurian Tom', 1, '0'),
(6, 2, 16, 2160, 'Need a smartphone for online class', '../../../public/assets/documents/request/1651601862.pdf', 'Kurian Tom', 3, 'sdf sdfs df sdfs df sdf '),
(7, 2, 16, 2160, 'Public water tape leak is getting bigger', '0', 'Wade Warren', 3, 'reject'),
(8, 2, 16, 2160, 'Sport bikers doing stunt on nearby ground everyday.', '0', '0', 0, '0'),
(9, 2, 16, 2160, 'Street water tape is leak', '0', 'Wade Warren', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(10) NOT NULL,
  `wardno` int(10) NOT NULL,
  `notification_title` varchar(100) NOT NULL,
  `notification_des` varchar(1000) NOT NULL,
  `notification_for` varchar(100) NOT NULL,
  `hm` int(10) NOT NULL DEFAULT 0,
  `os` int(10) NOT NULL DEFAULT 0,
  `date_time` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `wardno`, `notification_title`, `notification_des`, `notification_for`, `hm`, `os`, `date_time`) VALUES
(1, 2, 'Egg distribution', 'Egg distribution will be conducted on 22nd june 2022. Every house will be allotted 20 eggs. Necessary ID proof and ration card should be brought.', 'House members, ', 1, 0, '2022-05-06 23:53:28.352593'),
(2, 2, 'Covid awareness class', 'Covid awareness class will be conducted in 15th june 2022. At least one member of a house should participate. Event will be conducted on School auditorium at 10am.', 'House members, Office staffs, ', 1, 1, '2022-05-06 23:54:25.555483'),
(3, 2, 'Vegetable seed distribution', 'Vegetable seed distribution will be conducted on 20th july 2022. Further information will be informed soon.', 'House members, ', 1, 0, '2022-05-06 23:54:43.525768');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_office_staff`
--

CREATE TABLE `tbl_office_staff` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phno` bigint(12) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `m_house` int(1) NOT NULL DEFAULT 0,
  `m_committee` int(1) NOT NULL DEFAULT 0,
  `m_complaint` int(1) NOT NULL DEFAULT 0,
  `wardno` int(5) NOT NULL,
  `userid` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_office_staff`
--

INSERT INTO `tbl_office_staff` (`id`, `name`, `email`, `phno`, `photo`, `m_house`, `m_committee`, `m_complaint`, `wardno`, `userid`, `status`, `password`) VALUES
(1, 'Wade Warren', 'wadewarren@gmail.com', 9854587857, '../../../public/assets/images/uploads/photos/1651301022.png', 1, 1, 1, 2, 2001, 1, 'Qwerty@123'),
(2, 'Telbin Cherian', 'telbin@gmail.com', 9854523265, '../../../public/assets/images/uploads/photos/1648462655.jpg', 0, 0, 0, 2, 2002, 1, 'Qwerty@123'),
(3, 'Kurian Tom', 'lskdnv@gmail.com', 9653235687, '../../../public/assets/images/uploads/photos/1648463311.jpeg', 0, 0, 1, 2, 2003, 1, 'Qwerty@123'),
(4, 'test', 'test@gmail.com', 8565487898, '../../../public/assets/images/uploads/photos/1650020330.png', 1, 0, 1, 3, 3001, 1, 'M5TF1Woc'),
(5, 'new staff', 'sdfsdf@gmail.com', 9854587895, '../../../public/assets/images/uploads/photos/1651301311.png', 0, 0, 0, 2, 2004, 0, '123');

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
(2, 2232, 'Software developer', '0', 'TCS', 'Red street', '0000-00-00'),
(3, 2235, 'Music Producer', '0', 'STMPD RCRD', '0', '0000-00-00'),
(4, 2480, '0', '0', '0', '0', '0000-00-00'),
(5, 2780, '0', '0', '0', '0', '0000-00-00'),
(6, 2140, '0', '0', '0', '0', '0000-00-00'),
(7, 21470, '0', '0', '0', '0', '0000-00-00'),
(8, 21580, '0', '0', '0', '0', '0000-00-00'),
(9, 230, '0', '0', '0', '0', '0000-00-00'),
(10, 260, '0', '0', '0', '0', '0000-00-00'),
(11, 270, '0', '0', '0', '0', '0000-00-00'),
(12, 290, '0', '0', '0', '0', '0000-00-00'),
(13, 280, '0', '0', '0', '0', '0000-00-00'),
(14, 2540, '0', '0', '0', '0', '0000-00-00'),
(15, 2542, '0', '0', '0', '0', '0000-00-00'),
(16, 2850, '0', '0', '0', '0', '0000-00-00'),
(17, 2450, '0', '0', '0', '0', '0000-00-00'),
(18, 2130, '0', '0', '0', '0', '0000-00-00'),
(19, 2132, '0', '0', '0', '0', '0000-00-00'),
(20, 2133, '0', '0', '0', '0', '0000-00-00'),
(21, 2134, '0', '0', '0', '0', '0000-00-00'),
(22, 2135, '0', '0', '0', '0', '0000-00-00'),
(23, 2136, '0', '0', '0', '0', '0000-00-00'),
(24, 2137, '0', '0', '0', '0', '0000-00-00'),
(25, 2530, '0', '0', '0', '0', '0000-00-00'),
(26, 2430, '0', '0', '0', '0', '0000-00-00'),
(27, 2160, '0', '0', '0', '0', '0000-00-00'),
(28, 2162, '0', '0', '0', '0', '0000-00-00'),
(29, 2110, '0', '0', '0', '0', '0000-00-00'),
(30, 2162, '0', '0', '0', '0', '0000-00-00'),
(31, 2163, '0', '0', '0', '0', '0000-00-00'),
(32, 2164, '0', '0', '0', '0', '0000-00-00'),
(33, 21250, '0', '0', '0', '0', '0000-00-00'),
(34, 21440, '0', '0', '0', '0', '0000-00-00'),
(35, 2410, '0', '0', '0', '0', '0000-00-00'),
(36, 2190, '0', '0', '0', '0', '0000-00-00'),
(37, 21220, '0', '0', '0', '0', '0000-00-00'),
(38, 21230, '0', '0', '0', '0', '0000-00-00'),
(39, 21120, '0', '0', '0', '0', '0000-00-00'),
(40, 21460, '0', '0', '0', '0', '0000-00-00'),
(41, 310, '0', '0', '0', '0', '0000-00-00'),
(42, 312, '0', '0', '0', '0', '0000-00-00'),
(43, 21690, '0', '0', '0', '0', '0000-00-00'),
(44, 2420, '0', '0', '0', '0', '0000-00-00');

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
(25, 'Maamachan', 'albinpthomas@mca.ajce.in', 9856547854, 2, 158, '6589856587', 1),
(27, 'Frank Thomas', 'frankmathewsthomas@mca.ajce.in', 9856548785, 2, 154, '1256325879', 1),
(28, 'laali', 'laali@ed.fvv', 8785698745, 2, 147, '1523658795', 1),
(29, 'Laali Bhaai', 'laa@gmz.ff', 5485478965, 2, 14, '1523659875', 1),
(31, 'aaa', 'aaa@gmail.com', 9547586965, 2, 15, '8569857458', 1),
(35, 'test', 'test@gmail.com', 5478965256, 2, 143, '1258963254', 1),
(38, 'test', 'test@gmail.com', 5456765679, 2, 56, '../documents/taxreport/1643748995.pdf', 1),
(39, 'test', 'test@gmail.com', 5467543345, 2, 5, '../documents/taxreport/1643751741.pdf', 1),
(40, 'Manas test', 'manasp@mca.ajce.in', 7678976780, 2, 4, '../documents/taxreport/1643752792.pdf', 1),
(42, 'new test', 'newtest@gmail.com', 9858356478, 2, 34, '../documents/taxreport/1643837559.pdf', 1),
(43, 'new reg', 'newreg@gmail.com', 5458965879, 2, 18, '../documents/taxreport/1643969173.pdf', 1),
(44, 'David Guetta', 'davidguetta@gmail.com', 9565878452, 2, 23, '../documents/taxreport/1644592357.pdf', 1),
(45, 'Martin Garrix', 'martingrx@gmail.com', 9565878457, 2, 24, '../documents/taxreport/1644593477.pdf', 1),
(46, 'dont accept', 'sont@gmail.com', 9565878454, 2, 78, '../documents/taxreport/1644595851.pdf', 1),
(47, 'kunnuz', 'kunnu@gmail.com', 9565874587, 2, 48, '../documents/taxreport/1644849229.pdf', 1),
(49, 'qwe', 'qwe@gmail.com', 8545878954, 3, 1, '../documents/taxreport/1645463088.pdf', 1),
(50, 'asd', 'ads@gmail.com', 9565451258, 2, 3, '../documents/taxreport/1645502488.pdf', 1),
(51, 'qwe', 'qwe@gmail.com', 9856587458, 2, 6, '../documents/taxreport/1645545832.pdf', 1),
(52, 'ert', 'ert@gmail.com', 9587845236, 2, 7, '../documents/taxreport/1645545858.pdf', 1),
(53, 'rty', 'rty@gmail.com', 9854587845, 2, 9, '../documents/taxreport/1645554420.pdf', 1),
(54, 'sdf', 'sdf@gmail.com', 9856523587, 2, 8, '../documents/taxreport/1645555665.pdf', 1),
(55, 'tuyu', 'fgh@gmail.com', 9856587845, 2, 19, '../documents/taxreport/1645589316.pdf', 1),
(57, 'fgh', 'fgh@gmail.com', 9856587845, 2, 85, '../documents/taxreport/1645589914.pdf', 1),
(58, 'Nikky George', 'nikkygeorgephilip@mca.ajce.in', 9565878544, 2, 54, '../documents/taxreport/1645589974.pdf', 1),
(59, 'sdf', 'dfg@gmail.com', 9584524655, 2, 13, '../documents/taxreport/1645591942.pdf', 1),
(60, 'new test', 'lkjnhk@gmail.com', 9856587854, 2, 45, '../documents/taxreport/1645593021.pdf', 1),
(62, 'fghefs', 'fghf@gmail.com', 9856587845, 2, 41, '../documents/taxreport/1645634535.pdf', 1),
(63, 'djkfhg', 'jb@gmail.com', 9854589858, 2, 53, '../documents/taxreport/1645634562.pdf', 1),
(65, 'tyutut', 'tyutyu@gmail.com', 9565458785, 2, 43, '../documents/taxreport/1646710445.pdf', 1),
(66, 'chknew', 'chknew@gmail.com', 9854587452, 2, 144, '../../assets/documents/taxreport/1647660841.pdf', 1),
(67, 'hjkkh hjk', 'dsfg@gmai.coj', 4523256587, 2, 125, '../../assets/documents/taxreport/1647660965.pdf', 1),
(69, 'new chk', 'nwwechk@gmail.com', 9854512547, 2, 16, '../../public/assets/documents/taxreport/1648015712.pdf', 1),
(70, 'Frank', 'frankmathewsthomas@gmail.com', 9875456324, 2, 11, '../../public/assets/documents/taxreport/1648784715.pdf', 1),
(72, 'chech staff', 'chkstaff@gmail.com', 9854562321, 2, 122, '../../public/assets/documents/taxreport/1651347683.pdf', 1),
(73, 'chech ward mem', 'chkmem@gmail.com', 9854563210, 2, 123, '../../public/assets/documents/taxreport/1651347757.pdf', 1),
(74, 'tset time', 'tefy@gmail.cm', 9854512547, 2, 112, '../../public/assets/documents/taxreport/1651349066.pdf', 1),
(78, 'Ligin Abraham', 'liginab@gmail.com', 9854541254, 2, 87, '../../public/assets/documents/taxreport/1652153201.pdf', 0),
(79, 'Telbin Cherian', 'telbincherian@gmail.com', 8545795231, 2, 46, '../../public/assets/documents/taxreport/1652153363.pdf', 0),
(80, 'Tellbin Cherian', 'telbincherian@mca.ajce.in', 9856545878, 2, 169, '../../public/assets/documents/taxreport/1653461272.pdf', 1),
(81, 'test mail', 'manasp@mca.ajce.in', 9854512547, 2, 42, '../../public/assets/documents/taxreport/1654449092.pdf', 1),
(82, 'Akshai Biju', 'akshaibiju@mca.ajce.in', 7485658785, 2, 47, '../../public/assets/documents/taxreport/1654620542.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_activity`
--

CREATE TABLE `tbl_staff_activity` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `date_time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff_activity`
--

INSERT INTO `tbl_staff_activity` (`id`, `userid`, `name`, `activity`, `date_time`) VALUES
(1, 2001, 'Wade Warren', 'Approved house having house number: 25', '2022-04-30 21:28:21.000000'),
(2, 2001, 'Wade Warren', 'Approved house having house number: 41', '2022-04-30 21:28:47.000000'),
(3, 2001, 'Wade Warren', 'Approved house having house number: 19', '2022-04-30 21:32:21.000000'),
(4, 2001, 'Wade Warren', 'Approved house having house number: 17', '2022-04-30 21:39:55.000000'),
(5, 2001, 'Wade Warren', 'Approved house having house number: 122', '2022-04-30 21:41:47.000000'),
(6, 2001, 'Wade Warren', 'Approved house having house number: 112', '2022-04-30 22:04:38.000000'),
(7, 2001, 'Wade Warren', 'Approved house having house number: 146', '2022-05-01 01:37:21.000000'),
(8, 2001, 'Wade Warren', 'Rejected house having house number:  with reason: Invalid house tax report', '2022-05-01 18:35:08.000000'),
(9, 2001, 'Wade Warren', 'Rejected house having house number: 142 with reason: Invalid house tax report and suspicious feeling', '2022-05-01 18:38:49.000000'),
(10, 2001, 'Wade Warren', 'Updated house having house number: 16', '2022-05-02 11:51:32.000000'),
(11, 2001, 'Wade Warren', 'Updated house having house number: 23', '2022-05-02 11:52:42.000000'),
(12, 2001, 'Wade Warren', 'Updated house having house number: 16 and changed ownership to David Guetta from Manas', '2022-05-02 11:55:35.000000'),
(13, 2001, 'Wade Warren', 'Deleted house member having user id: 2164 and house number: 16 with reason: House member does not exist in this realm', '2022-05-02 11:57:44.000000'),
(14, 2001, 'Wade Warren', 'Forwarded need request requested by Manas of house: 16', '2022-05-03 18:49:21.000000'),
(17, 2001, 'Wade Warren', 'Rejected need request requested by new member of house: 16 with the reason: Invalid information, please re-apply with valid information.', '2022-05-03 22:49:20.000000'),
(18, 2001, 'Wade Warren', 'Forwarded need request requested by Manas of house: 16', '2022-05-03 23:42:52.000000'),
(19, 2001, 'Wade Warren', 'Forwarded need request requested by Manas of house: 16', '2022-05-03 23:48:10.000000'),
(20, 2003, 'Kurian Tom', 'Rejected need request requested by Manas of house: 16 with the reason: sdf sdfs df sdfs df sdf ', '2022-05-03 23:49:13.000000'),
(21, 2003, 'Kurian Tom', 'Forwarded need request requested by Manas of house: 16', '2022-05-04 09:10:43.000000'),
(22, 2001, 'Wade Warren', 'Forwarded need request requested by Manas of house: 16', '2022-05-04 11:30:02.000000'),
(23, 2003, 'Kurian Tom', 'Forwarded need request requested by Kurien Tom of house: 16', '2022-06-06 23:16:13.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_street_light`
--

CREATE TABLE `tbl_street_light` (
  `id` int(10) NOT NULL,
  `street_light_no` varchar(10) NOT NULL,
  `locality` varchar(200) NOT NULL,
  `ward_no` int(10) NOT NULL,
  `houseno` varchar(200) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_street_light`
--

INSERT INTO `tbl_street_light` (`id`, `street_light_no`, `locality`, `ward_no`, `houseno`, `status`) VALUES
(5, 'C52', 'Kottooli, Near Fresco supermarket', 2, '145, ', 1),
(6, 'C12', 'Mankav, Near pond', 2, '5, 16, ', 1),
(9, 'C10', 'Koovoor, Near supermarket', 2, '18, ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `task_des` varchar(500) NOT NULL,
  `assignees` int(10) NOT NULL DEFAULT 0,
  `created_by` int(10) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `deadline` varchar(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`id`, `c_id`, `task_name`, `task_des`, `assignees`, `created_by`, `created_date`, `deadline`, `status`) VALUES
(1, 2222, 'Medicine Distribution', 'The flood hit Kerala is now facing the shortage of drugs leaving many staying in rehabilitation camps across the state without essential medicines. Authorities and NGOs are unable to cater to the needs of those at relief camps due to shortage of medicines as well as lack of transportation facilities.', 2, 2, '2022-05-13', '2022-06-15', 0),
(2, 2222, 'Food Distribution', 'A team from Combat Vehicles Research & Development Establishment (CVRDE), Avadi along with city officials distributed three tonnes ready-to-eat food material at different relief camps in Tiruvallur and Chennai district. The four-day long relief distribution concluded on Sunday.', 1, 2, '2022-05-15', '2022-06-05', 0),
(3, 2222, 'Cloth Distribution', 'MAM provided food and clothing to thousands of flood victims, including blankets, clothes and other essentials for the victims of the flood in Kerala.', 0, 2, '2022-05-17', '2022-05-31', 0),
(4, 2223, 'gcfgc', 'vjfh', 1, 2, '2022-05-17', '2022-05-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_member`
--

CREATE TABLE `tbl_task_member` (
  `id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `tsk_id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_task_member`
--

INSERT INTO `tbl_task_member` (`id`, `com_id`, `tsk_id`, `userid`, `status`) VALUES
(1, 2222, 1, 2234, 0),
(2, 2222, 1, 2232, 0),
(3, 2223, 4, 2160, 0),
(4, 2222, 2, 2232, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_report`
--

CREATE TABLE `tbl_task_report` (
  `id` int(10) NOT NULL,
  `tsk_id` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `photo1` varchar(100) NOT NULL DEFAULT '0',
  `photo2` varchar(100) NOT NULL DEFAULT '0',
  `photo3` varchar(100) NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_task_report`
--

INSERT INTO `tbl_task_report` (`id`, `tsk_id`, `com_id`, `userid`, `title`, `description`, `date`, `photo1`, `photo2`, `photo3`, `status`) VALUES
(21, 1, 2222, 2232, 'Fever Medicine Distributed', 'Fever medicines line paracetamol 500, dolo and other medicines which where necessary at south camp where distributed.', '2022-06-09', '../../../public/assets/images/uploads/photos/16547319270.jpg', '../../../public/assets/images/uploads/photos/16547319271.jpg', '../../../public/assets/images/uploads/photos/16547319272.jpg', 0);

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
(1, 'Wade Warren', 'wade@gmail.com', 9854875632, 1, '2027-10-13', '../../../public/assets/images/uploads/photos/1637689913.png', 0, 1, 'Qwerty@123'),
(2, 'Manas P', 'manas4518pachakkil@gmail.com', 9446184519, 2, '2027-10-13', '../../../public/assets/images/uploads/photos/1637437831.png', 0, 1, 'Qwerty@123'),
(3, 'Annette Black', 'annette@gmail.com', 9845587455, 3, '2027-10-13', '../../../public/assets/images/uploads/photos/1637438042.png', 0, 1, 'Qwerty@123'),
(4, 'Marvin McKinney', 'marvin@gmail.com', 9865478524, 4, '2027-10-13', '../../../public/assets/images/uploads/photos/1637438149.png', 0, 1, 'Yl6Xxf2p'),
(5, 'Savannah Htuga', 'savannah@gmail.com', 7458965237, 5, '2027-10-13', '../../../public/assets/images/uploads/photos/1637438202.png', 0, 1, 'UNmwfQ4j'),
(6, 'Kurian Tom', 'kuriantom@mca.ajce.in', 9856547854, 6, '2027-10-13', '../../../public/assets/images/uploads/photos/1637516935.jpeg', 0, 1, 'ILMxnMgV'),
(7, 'Telbin Cherian', 'telbincherian@mca.ajce.in', 9856587745, 7, '2027-10-13', '../../../public/assets/images/uploads/photos/1647929084.jpg', 0, 1, 'laEQbXxJ'),
(8, 'Vinu Reji John', 'vinurejijohn21@gmail.com', 9856687458, 8, '2027-10-13', '../../../public/assets/images/uploads/photos/1637659458.jpg', 0, 1, 'AyNAxXRD'),
(9, 'Mrudul A', 'ganjan@gmail.com', 9565874587, 9, '2027-10-13', '../../../public/assets/images/uploads/photos/1637837216.png', 0, 1, 'Bxs3FNtl'),
(10, 'James George', 'jamesgeorge@gmail.com', 9568784523, 10, '2027-10-13', '../../../public/assets/images/uploads/photos/1638012009.png', 0, 1, 'l6lrouag'),
(11, 'James Bond', 'newmwmber@gmail.com', 9854589655, 11, '2027-10-13', '../../../public/assets/images/uploads/photos/1645632011.png', 0, 1, '4rK9Wa9C'),
(12, 'John Doe', 'test@gmail.com', 9854587845, 12, '2027-10-13', '../../../public/assets/images/uploads/photos/1647775793.png', 0, 1, 'nhHJODZB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `tbl_committee`
--
ALTER TABLE `tbl_committee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wardno` (`wardno`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `tbl_committee_member`
--
ALTER TABLE `tbl_committee_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`,`c_userid`);

--
-- Indexes for table `tbl_committee_req`
--
ALTER TABLE `tbl_committee_req`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`,`userid`);

--
-- Indexes for table `tbl_edu_bg`
--
ALTER TABLE `tbl_edu_bg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_e_doc`
--
ALTER TABLE `tbl_e_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forgot_password`
--
ALTER TABLE `tbl_forgot_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_house`
--
ALTER TABLE `tbl_house`
  ADD PRIMARY KEY (`hid`),
  ADD KEY `house_no` (`house_no`,`ward_no`);

--
-- Indexes for table `tbl_house_member`
--
ALTER TABLE `tbl_house_member`
  ADD PRIMARY KEY (`hm_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_id_proof`
--
ALTER TABLE `tbl_id_proof`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_need_request`
--
ALTER TABLE `tbl_need_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wardno` (`wardno`,`houseno`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wardno` (`wardno`);

--
-- Indexes for table `tbl_office_staff`
--
ALTER TABLE `tbl_office_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `wardno` (`wardno`);

--
-- Indexes for table `tbl_pro_bg`
--
ALTER TABLE `tbl_pro_bg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `wardno` (`wardno`,`houseno`);

--
-- Indexes for table `tbl_staff_activity`
--
ALTER TABLE `tbl_staff_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tbl_street_light`
--
ALTER TABLE `tbl_street_light`
  ADD PRIMARY KEY (`id`),
  ADD KEY `street_light_no` (`street_light_no`,`houseno`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_member`
--
ALTER TABLE `tbl_task_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_report`
--
ALTER TABLE `tbl_task_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tsk_id` (`tsk_id`,`com_id`);

--
-- Indexes for table `tbl_ward_member`
--
ALTER TABLE `tbl_ward_member`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `wardno` (`wardno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_committee`
--
ALTER TABLE `tbl_committee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_committee_member`
--
ALTER TABLE `tbl_committee_member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_committee_req`
--
ALTER TABLE `tbl_committee_req`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_edu_bg`
--
ALTER TABLE `tbl_edu_bg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_e_doc`
--
ALTER TABLE `tbl_e_doc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_forgot_password`
--
ALTER TABLE `tbl_forgot_password`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_house`
--
ALTER TABLE `tbl_house`
  MODIFY `hid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_house_member`
--
ALTER TABLE `tbl_house_member`
  MODIFY `hm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_id_proof`
--
ALTER TABLE `tbl_id_proof`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_need_request`
--
ALTER TABLE `tbl_need_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_office_staff`
--
ALTER TABLE `tbl_office_staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pro_bg`
--
ALTER TABLE `tbl_pro_bg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `rid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_staff_activity`
--
ALTER TABLE `tbl_staff_activity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_street_light`
--
ALTER TABLE `tbl_street_light`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_task_member`
--
ALTER TABLE `tbl_task_member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_task_report`
--
ALTER TABLE `tbl_task_report`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_ward_member`
--
ALTER TABLE `tbl_ward_member`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
