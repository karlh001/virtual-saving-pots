-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2022 at 03:34 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountsT`
--

CREATE TABLE `accountsT` (
  `accountID` int NOT NULL,
  `profile_ID` int NOT NULL COMMENT 'Links to profileT table',
  `acc_ref` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Unique reference for web broswer',
  `acc_name` varchar(150) CHARACTER SET latin1 NOT NULL COMMENT 'name of account',
  `acc_comment` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Details about the account',
  `acc_notes` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'Personalised notes for each account displayed on transaction page',
  `acc_enabled` int DEFAULT '1',
  `acc_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of accounts used to store transactions';

-- --------------------------------------------------------

--
-- Table structure for table `profileT`
--

CREATE TABLE `profileT` (
  `profile_ID` int NOT NULL COMMENT 'Unique row ID',
  `profile_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'User-friendly profile name',
  `profile_description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Description of profile',
  `profile_active` int NOT NULL DEFAULT '1' COMMENT 'If 1 then GUI will display the profile',
  `profile_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date and time row was created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of profiles to separate accounts';

--
-- Dumping data for table `profileT`
--

INSERT INTO `profileT` (`profile_ID`, `profile_name`, `profile_description`, `profile_active`, `profile_created`) VALUES
(1, 'Default', 'The default profile', 1, '2022-07-30 12:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `transactionsT`
--

CREATE TABLE `transactionsT` (
  `transID` int NOT NULL,
  `trans_accountID` int NOT NULL,
  `tran_date` date NOT NULL COMMENT 'User defined date',
  `tran_comment` varchar(150) CHARACTER SET latin1 NOT NULL COMMENT 'Description of transaction',
  `tran_amount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Transaction amount',
  `trans_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'timestamp stored into the db',
  `tran_enabled` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='List of transactions';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountsT`
--
ALTER TABLE `accountsT`
  ADD PRIMARY KEY (`accountID`),
  ADD UNIQUE KEY `acc_ref` (`acc_ref`),
  ADD KEY `profile_ID` (`profile_ID`);

--
-- Indexes for table `profileT`
--
ALTER TABLE `profileT`
  ADD PRIMARY KEY (`profile_ID`);

--
-- Indexes for table `transactionsT`
--
ALTER TABLE `transactionsT`
  ADD PRIMARY KEY (`transID`),
  ADD KEY `trans_accountID` (`trans_accountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountsT`
--
ALTER TABLE `accountsT`
  MODIFY `accountID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profileT`
--
ALTER TABLE `profileT`
  MODIFY `profile_ID` int NOT NULL AUTO_INCREMENT COMMENT 'Unique row ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactionsT`
--
ALTER TABLE `transactionsT`
  MODIFY `transID` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
