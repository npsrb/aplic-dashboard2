-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 03:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `action_id` varchar(45) NOT NULL,
  `action_add` varchar(45) DEFAULT NULL,
  `action_edit` int(11) DEFAULT NULL,
  `action_delete` varchar(45) NOT NULL,
  `action_view` varchar(255) DEFAULT NULL,
  `level_level_id` varchar(255) DEFAULT NULL,
  `page_page_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action_id`, `action_add`, `action_edit`, `action_delete`, `action_view`, `level_level_id`, `page_page_id`) VALUES
('asdb', 'sadb', 123, 'a', 'asdas ', 'asdavsdasv', 'asdvas');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` varchar(45) NOT NULL,
  `content_name` varchar(45) DEFAULT NULL,
  `content_detail` text DEFAULT NULL,
  `content_order` int(11) DEFAULT NULL,
  `content_link` varchar(45) DEFAULT NULL,
  `content_ava` text DEFAULT NULL,
  `menu_menu_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_has_picture`
--

CREATE TABLE `content_has_picture` (
  `content_content_id` varchar(45) NOT NULL,
  `picture_picture_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` varchar(45) NOT NULL,
  `level_name` varchar(45) DEFAULT NULL,
  `level_detail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(45) NOT NULL,
  `menu_name` varchar(45) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `menu_link` varchar(45) NOT NULL,
  `menu_title` varchar(255) DEFAULT NULL,
  `menu_keyword` varchar(255) DEFAULT NULL,
  `menu_desc` varchar(255) DEFAULT NULL,
  `menu_status` varchar(45) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_order`, `menu_link`, `menu_title`, `menu_keyword`, `menu_desc`, `menu_status`) VALUES
(1, 'Approval56', 1, 'google.com', 'Dashboard', 'approval', 'Dashboard', 'Active'),
(3, 'abdan', 123123, 'google.com', 'Approval', 'Dashboard', 'Dashboard', 'Active'),
(4, 'Menu', 1, 'menu', 'Menu', 'Menu', 'menu deskripsi', 'active'),
(5, 'Approvale', 1, 'google.com', 'Approval', 'Dashboard', 'Dashboard', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `menu_has_picture`
--

CREATE TABLE `menu_has_picture` (
  `menu_menu_id` varchar(45) NOT NULL,
  `picture_picture_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` varchar(45) NOT NULL,
  `page_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `picture_id` varchar(45) NOT NULL,
  `picture_name` varchar(255) NOT NULL,
  `picture_location` text NOT NULL,
  `picture_tag` varchar(45) DEFAULT NULL,
  `picture_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(20) NOT NULL,
  `request_name` varchar(50) NOT NULL,
  `briefdescription` text NOT NULL,
  `firstdate` date NOT NULL DEFAULT current_timestamp(),
  `seconddate` date NOT NULL,
  `RequestStatus` varchar(50) NOT NULL,
  `file` varchar(45) NOT NULL,
  `Detail` text NOT NULL,
  `user_user_id` varchar(20) NOT NULL,
  `user_lead` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `request_name`, `briefdescription`, `firstdate`, `seconddate`, `RequestStatus`, `file`, `Detail`, `user_user_id`, `user_lead`) VALUES
(1, 'Annual Leave', 'percobaan 1', '2023-01-16', '2023-01-19', 'Reject', '1', '1', '1', ''),
(123, 'Annual Leave', 'Liburan Tahunan', '2023-01-01', '2023-01-31', 'Not Approve', 'file', 'Full Name :  Sick Date : 2023-01-01 - 2023-01-31 Total Sick Leave : 5', '3', 'admin'),
(167, 'Annual Leave', 'annual leave', '2023-01-16', '2023-01-18', 'Reject', '1.docx', 'keterangan', '1', ''),
(168, 'cuti', 'brief', '2023-01-16', '2023-01-20', '2', '1.docs', 'detail', '1', ''),
(169, 'Married(family) Leave', 'adesc', '2023-01-16', '2023-01-19', '2', '1.docs', '2', '1', ''),
(170, 'Annual Leave', 'desc', '2023-01-16', '2023-01-18', 'Approve', '12', 'aaa', '1', ''),
(171, 'Annual Leave', 'abs', '2023-01-19', '2023-01-27', 'Reject', 'file', '123', '1', ''),
(172, 'Annual Leave', ' console.log(response);', '2023-01-19', '2023-01-10', 'Approve', 'file', ' console.log(response);', '1', ''),
(173, 'Annual Leave', 'startDate', '2023-01-19', '2023-01-02', 'Approve', 'file', 'startDate', '1', ''),
(174, 'Annual Leave', 'startDate', '2023-01-19', '2023-01-04', 'Reject', 'file', 'startDate', '1', ''),
(175, 'Annual Leave', 'cek firstdate dan second date', '2023-01-19', '2023-01-26', 'Not Approve', 'file', 'cek firstdate dan second date', '1', ''),
(176, 'Annual Leave', 'Start date must be greater than end date', '2023-01-19', '2023-01-27', 'Not Approve', 'file', 'Start date must be greater than end date', '1', ''),
(177, 'Annual Leave', 'session baru', '2023-01-24', '2023-01-26', 'Approve', 'file', 'session baru', '', ''),
(178, 'Annual Leave', 'sewssion', '2023-01-24', '2023-01-26', 'Not Approve', 'file', 'Full Name : Muhammad Abdan Ghiffari Sick Date : 03/06/2022 - 03/06/2022 Total Sick Leave : 1', '3', ''),
(179, 'Annual Leave', 'liburan', '2023-01-25', '2023-01-30', 'Not Approve', 'file', 'Full Name : Muhammad Abdan Ghiffari Sick Date : 03/06/2022 - 03/06/2022 Total Sick Leave : 1', '2', ''),
(180, 'Annual Leave', 'annual leave test manager', '2023-01-26', '2023-01-31', 'Not Approve', 'file', 'Full Name : Muhammad Abdan Ghiffari Sick Date : 03/06/2022 - 03/06/2022 Total Sick Leave : 1', '3', 'admin'),
(181, 'Annual Leave', 'annual leave', '2023-01-26', '2023-02-06', 'Not Approve', 'file', 'Full Name : Muhammad Abdan Ghiffari Sick Date : 03/06/2022 - 03/06/2022 Total Sick Leave : 1', '3', 'admin'),
(182, 'Annual Leave', 'Liburan Tahunan', '2023-01-01', '2023-01-31', 'Not Approve', 'file', 'Full Name : 3 Sick Date : 2023-01-01 - 2023-01-31 Total Sick Leave : 5', '3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

CREATE TABLE `sub` (
  `sub_id` varchar(45) NOT NULL,
  `sub_name` text DEFAULT NULL,
  `sub_detail` text DEFAULT NULL,
  `sub_extend` text DEFAULT NULL,
  `content_content_id` varchar(45) NOT NULL,
  `sub_ava` text DEFAULT NULL,
  `sub_date` date DEFAULT NULL,
  `sub_link` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_has_picture`
--

CREATE TABLE `sub_has_picture` (
  `sub_sub_id` varchar(45) NOT NULL,
  `picture_picture_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_date` timestamp NULL DEFAULT current_timestamp(),
  `user_phone` varchar(45) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_type` varchar(45) DEFAULT 'Customer',
  `user_status` varchar(45) DEFAULT 'New',
  `leaveamount` int(20) NOT NULL,
  `position` varchar(20) NOT NULL,
  `lead` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_date`, `user_phone`, `user_address`, `user_type`, `user_status`, `leaveamount`, `position`, `lead`) VALUES
('1', 'admin', 'ABA@GMAIL.COM', '2', '2023-01-22 17:00:00', '081383434641', 'tawakkal ujung 26', 'ASDASD', '123123', 2, 'T2', ''),
('2', 'ABDAN', 'ABA@GMAIL.COM', '3', '2023-01-02 17:00:00', '081383434641', 'tawakkal ujung 26', 'ASDASD', 'ASDASDASD', 6, 'T1', 'admin'),
('3', 'abdanae1', 'abdan', '1', '2023-01-24 06:44:02', 'aa', 'aaa', 'Customer', 'New', 5, 'T1', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `fk_content_menu_idx` (`menu_menu_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_user_id` (`user_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
