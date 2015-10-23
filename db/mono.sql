-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2015 at 06:51 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mono`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE IF NOT EXISTS `tbl_accounts` (
  `accounts_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activated` varchar(5) NOT NULL,
  `balance` int(255) NOT NULL DEFAULT '0',
  `total_earnings` int(255) NOT NULL DEFAULT '0',
  `role` varchar(25) NOT NULL,
  `package_id` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`accounts_id`, `username`, `password`, `email`, `activated`, `balance`, `total_earnings`, `role`, `package_id`) VALUES
(1, 'admin', '12345', 'admin@gmail.com', '1', 0, 0, '1', '1'),
(3, 'satch', '1234', 'asd', '1', 0, 0, '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cycle`
--

CREATE TABLE IF NOT EXISTS `tbl_cycle` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `account_link` varchar(255) NOT NULL,
  `cycle_count` varchar(255) NOT NULL,
  `cycle_link` varchar(255) NOT NULL,
  `cycle_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE IF NOT EXISTS `tbl_package` (
  `package_id` int(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `possible_earning` int(255) NOT NULL,
  `cycle_earn` int(255) NOT NULL,
  `account_count` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`package_id`, `package_name`, `possible_earning`, `cycle_earn`, `account_count`) VALUES
(1, 'Test Package233', 25000, 750, 60);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_relation`
--

CREATE TABLE IF NOT EXISTS `tbl_relation` (
  `id` int(255) NOT NULL,
  `parent` int(255) NOT NULL,
  `child` int(255) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdraw_history`
--

CREATE TABLE IF NOT EXISTS `tbl_withdraw_history` (
  `id` int(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `cp_number` varchar(255) NOT NULL,
  `accounts_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `current_balance` varchar(255) NOT NULL,
  `new_balance` varchar(255) NOT NULL,
  `history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `claim_status` varchar(2) NOT NULL DEFAULT '0',
  `bank_name` varchar(255) NOT NULL,
  `bank_accountnumber` varchar(255) NOT NULL,
  `bank_accountname` varchar(255) NOT NULL,
  `claimtype` varchar(25) NOT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `remit_name` varchar(255) NOT NULL,
  `smartpadala` varchar(255) NOT NULL,
  `transnum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`accounts_id`);

--
-- Indexes for table `tbl_cycle`
--
ALTER TABLE `tbl_cycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `tbl_relation`
--
ALTER TABLE `tbl_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_withdraw_history`
--
ALTER TABLE `tbl_withdraw_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `accounts_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_cycle`
--
ALTER TABLE `tbl_cycle`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `package_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_relation`
--
ALTER TABLE `tbl_relation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_withdraw_history`
--
ALTER TABLE `tbl_withdraw_history`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
