-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2017 at 08:10 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cidemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leaves`
--

CREATE TABLE IF NOT EXISTS `tbl_leaves` (
  `leave_id` int(11) NOT NULL,
  `leave_title` varchar(55) NOT NULL,
  `leave_type` varchar(55) NOT NULL,
  `leave_count` int(11) NOT NULL,
  `leave_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leaves`
--

INSERT INTO `tbl_leaves` (`leave_id`, `leave_title`, `leave_type`, `leave_count`, `leave_date`, `status`, `is_delete`) VALUES
(1, 'Casual Leave', 'Other', 6, '0000-00-00', 1, 0),
(2, 'Seek Leave', 'Other', 6, '1970-01-01', 1, 0),
(5, 'Labour Day', 'Holiday', 1, '2017-05-01', 1, 0),
(6, 'Patarnity Leave', 'Other', 7, '1970-01-01', 1, 0),
(11, 'Independence Day', 'Holiday', 1, '2017-08-15', 1, 0),
(12, 'Republic Day', 'Holiday', 1, '2017-01-26', 1, 0),
(13, 'Diwali', 'Holiday', 2, '1970-01-01', 0, 1),
(14, 'Chrismas', 'Holiday', 1, '2017-12-25', 1, 0),
(15, 'Marriage Leave', 'Other', 12, '1970-01-01', 1, 0),
(16, 'Privilege Leave', 'Other', 12, '1970-01-01', 1, 0),
(17, 'Matarnity Leave', 'Other', 180, '1970-01-01', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE IF NOT EXISTS `tbl_menus` (
  `menu_id` int(11) NOT NULL,
  `parent_menu_id` int(11) NOT NULL,
  `menu` varchar(25) NOT NULL,
  `menu_title` varchar(255) NOT NULL,
  `menu_url` varchar(500) NOT NULL,
  `status` int(8) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`menu_id`, `parent_menu_id`, `menu`, `menu_title`, `menu_url`, `status`, `is_delete`) VALUES
(1, 0, 'Menu Management', 'Menu Management', '', 1, 0),
(2, 0, 'User Management', 'User Management', '', 1, 0),
(3, 1, 'List Menu', 'List Menu', '<a href="/cidemo/index.php/menuController" onclick="loadMenuList()">List Menus</a>', 1, 0),
(4, 1, 'Add Menu', 'Add Menu', '<a href="#" data-toggle="modal" data-target="#menuModal" onClick="setMenuPopValues('''')">Add Menu</a>', 1, 0),
(5, 2, 'List User', 'List User', '<a href="/cidemo/index.php/loginController/admin_dashboard" onclick="loadUserList()">List Users</a>', 1, 0),
(6, 0, 'Role Management', 'Role Management', '', 1, 0),
(7, 6, 'List Roles', 'List Roles', '<a href="/cidemo/index.php/roleController" onclick="loadRoleList()">List Roles</a>', 1, 0),
(8, 6, 'Add Role', 'Add Role', '<a href="/cidemo/index.php/roleController/add_role_form">Add Role</a>', 1, 0),
(9, 0, 'Leaves Management', 'Leave Management', '', 1, 0),
(10, 9, 'List Leaves', 'List Leaves', '<a href="/cidemo/index.php/leavesController" onclick="loadLeavesList()">List Leaves</a>', 1, 0),
(11, 9, 'Add Leave', 'Add Leave', '<a href="/cidemo/index.php/leavesController/add_leave_form">Add Leave</a>', 1, 0),
(12, 0, 'Test', 'Test', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `role_access_id` int(11) NOT NULL,
  `status` int(8) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role`, `role_access_id`, `status`, `is_delete`) VALUES
(1, 'Administrator', 3, 1, 0),
(2, 'HR Manager', 3, 1, 0),
(3, 'PHP Developer', 2, 1, 0),
(4, 'Validation Engineer', 2, 1, 0),
(5, 'Project Manager', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_access`
--

CREATE TABLE IF NOT EXISTS `tbl_role_access` (
  `role_access_id` int(11) NOT NULL,
  `role_access` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role_access`
--

INSERT INTO `tbl_role_access` (`role_access_id`, `role_access`, `status`, `is_delete`) VALUES
(1, 'Read', 1, 0),
(2, 'Write', 1, 0),
(3, 'All', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usrs`
--

CREATE TABLE IF NOT EXISTS `tbl_usrs` (
  `id` int(8) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` varchar(8) NOT NULL,
  `role_id` int(11) NOT NULL,
  `reporting_person_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usrs`
--

INSERT INTO `tbl_usrs` (`id`, `fname`, `lname`, `mobile`, `username`, `password`, `email`, `dob`, `profile_pic`, `status`, `role_id`, `reporting_person_id`) VALUES
(1, 'Admin', 'Admin', '1234567890', 'admin', 'admin', 'admin@hotmail.com', '0000-00-00', '1485072839_photo.jpg', '1', 4, 6),
(8, 'Gourav Pandurang', 'Saraf', '9665236088', 'gourav', 'gourav', 'gouravsaraf1990@gmail.com', '0000-00-00', '1485273865_gourav.jpg', '1', 3, 6),
(7, 'Swapnil', 'Khobragade', '1234567890', 'swapnil', 'swapnil', 'khswapnil90@gmail.com', '0000-00-00', '', '0', 4, 6),
(6, 'Abhishek P', 'Saraf', '9730754067', 'abhishek', 'abhishek', 'apsaraf@hotmail.com', '0000-00-00', '1485188118_photo.jpg', '1', 3, 8),
(9, 'Utpal', 'Kadam', '8975704891', 'utpal', 'utpal', 'abhishek.saraf26@ymail.com', '0000-00-00', '1485872624_185540_253742631316795_6223323_n.jpg', '1', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_role_access`
--
ALTER TABLE `tbl_role_access`
  ADD PRIMARY KEY (`role_access_id`);

--
-- Indexes for table `tbl_usrs`
--
ALTER TABLE `tbl_usrs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_leaves`
--
ALTER TABLE `tbl_leaves`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_role_access`
--
ALTER TABLE `tbl_role_access`
  MODIFY `role_access_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_usrs`
--
ALTER TABLE `tbl_usrs`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
