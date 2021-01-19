-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 19, 2021 at 11:03 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `BorrowerID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Birthday` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Education` varchar(50) NOT NULL,
  `Profession` varchar(50) NOT NULL,
  `Income` int(11) NOT NULL,
  `PhoneNumber` bigint(11) NOT NULL,
  `Aadhar` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`BorrowerID`, `FirstName`, `LastName`, `Birthday`, `Gender`, `Education`, `Profession`, `Income`, `PhoneNumber`, `Aadhar`) VALUES
(50, 'borrower', 'borrower', '2000-05-05', 'Male', 'edu', 'pro', 20000, 9898989898, 121212121212),
(54, 'Monish', 'S', '2000-05-05', 'Male', 'Bachelors', 'Student', 50000, 9854985498, 858578784848);

-- --------------------------------------------------------

--
-- Table structure for table `lender`
--

CREATE TABLE `lender` (
  `LenderID` int(11) NOT NULL,
  `FIrstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Birthday` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `PhoneNumber` bigint(11) NOT NULL,
  `Aadhar` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lender`
--

INSERT INTO `lender` (`LenderID`, `FIrstName`, `LastName`, `Birthday`, `Gender`, `PhoneNumber`, `Aadhar`) VALUES
(49, 'lender', 'lender', '2000-05-05', 'Male', 7878787878, 123412341234),
(55, 'Likhith', 'SR', '2000-07-08', 'Male', 9856985698, 858745874587);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `LoanID` int(11) NOT NULL,
  `Status` int(11) NOT NULL COMMENT '0-Not Paid; 1-Paid',
  `BorrowerID` int(11) NOT NULL,
  `LenderID` int(11) NOT NULL,
  `ApplicationID` int(11) NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`LoanID`, `Status`, `BorrowerID`, `LenderID`, `ApplicationID`, `DateCreated`) VALUES
(1, 1, 50, 49, 1, '2021-01-12'),
(2, 1, 50, 49, 4, '2021-01-12'),
(3, 1, 54, 55, 5, '2021-01-13'),
(4, 1, 54, 55, 6, '2021-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `loan_application`
--

CREATE TABLE `loan_application` (
  `ApplicationID` int(11) NOT NULL,
  `Principal` int(11) NOT NULL,
  `Status` int(10) NOT NULL COMMENT '0-Applied; 1-Sanctioned',
  `BorrowerID` int(11) NOT NULL,
  `InterestRate` float NOT NULL,
  `Term` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `ApplicationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_application`
--

INSERT INTO `loan_application` (`ApplicationID`, `Principal`, `Status`, `BorrowerID`, `InterestRate`, `Term`, `Rating`, `ApplicationDate`) VALUES
(1, 50000, 1, 50, 12, 24, 44, '2021-01-12'),
(2, 50000, 0, 50, 5, 6, 32, '2021-01-12'),
(4, 50000, 1, 50, 15, 24, 39, '2021-01-12'),
(5, 450000, 1, 54, 15, 24, 15, '2021-01-13'),
(6, 60000, 1, 54, 15, 45, 71, '2021-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(30) NOT NULL,
  `LoanID` int(30) NOT NULL,
  `LenderID` int(11) NOT NULL,
  `BorrowerID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `Amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `LoanID`, `LenderID`, `BorrowerID`, `PaymentDate`, `Amount`) VALUES
(1, 1, 49, 50, '2021-01-12', 62000),
(2, 2, 49, 50, '2021-01-12', 65000),
(3, 3, 55, 54, '2021-01-13', 585000),
(4, 4, 55, 54, '2021-01-13', 93750);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2=lender, 3=borrower'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin123', 1),
(49, 'lender@lender.com', 'Lender123', 2),
(50, 'borrower1@borrower.com', 'borrower', 3),
(54, 'monish@gmail.com', 'Monish123', 3),
(55, 'likhith@gmail.com', 'Likhith123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`BorrowerID`),
  ADD UNIQUE KEY `Aadhar` (`Aadhar`);

--
-- Indexes for table `lender`
--
ALTER TABLE `lender`
  ADD PRIMARY KEY (`LenderID`),
  ADD UNIQUE KEY `Aadhar` (`Aadhar`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`LoanID`),
  ADD KEY `BorrowerID` (`BorrowerID`),
  ADD KEY `LenderID` (`LenderID`),
  ADD KEY `ApplicationID` (`ApplicationID`);

--
-- Indexes for table `loan_application`
--
ALTER TABLE `loan_application`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `BorrowerID` (`BorrowerID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `BorrowerID` (`BorrowerID`),
  ADD KEY `LenderID` (`LenderID`),
  ADD KEY `LoanID` (`LoanID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrower`
--
ALTER TABLE `borrower`
  ADD CONSTRAINT `borrower_ibfk_1` FOREIGN KEY (`BorrowerID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lender`
--
ALTER TABLE `lender`
  ADD CONSTRAINT `lender_ibfk_1` FOREIGN KEY (`LenderID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`BorrowerID`) REFERENCES `borrower` (`BorrowerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`LenderID`) REFERENCES `lender` (`LenderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loan_ibfk_3` FOREIGN KEY (`ApplicationID`) REFERENCES `loan_application` (`ApplicationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan_application`
--
ALTER TABLE `loan_application`
  ADD CONSTRAINT `loan_application_ibfk_1` FOREIGN KEY (`BorrowerID`) REFERENCES `borrower` (`BorrowerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`BorrowerID`) REFERENCES `borrower` (`BorrowerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`LenderID`) REFERENCES `lender` (`LenderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`LoanID`) REFERENCES `loan` (`LoanID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
