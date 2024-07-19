-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 03:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `CustUsername` varchar(20) NOT NULL,
  `CustPassword` varchar(60) NOT NULL,
  `CustFirstName` varchar(10) NOT NULL,
  `CustLastName` varchar(10) NOT NULL,
  `CustEmail` varchar(20) DEFAULT NULL,
  `CustPhoneNum` varchar(11) NOT NULL,
  `CustAddress` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `CustUsername`, `CustPassword`, `CustFirstName`, `CustLastName`, `CustEmail`, `CustPhoneNum`, `CustAddress`) VALUES
(1121, 'sabella04', '$2y$10$1qUA0sPXh9BHI2Otrg5XLuqJxXN7rMVuQ8OnImfLzDBWc0BMjRSeK', 'arnie', 'sabila', 'sabella@gmail.com', '01164013101', 'jalan abdul latif, bukit kapar'),
(1128, '', '', 'hafiz ', 'Ahmad', 'hafiz@gmail.com', '01192019282', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `EmpUsername` varchar(11) NOT NULL,
  `EmpPassword` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `EmpUsername`, `EmpPassword`) VALUES
(2002, 'staff12', 'staff12');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `totalPaid` decimal(10,0) NOT NULL,
  `paymentMethod` varchar(10) NOT NULL,
  `reservationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentDate`, `totalPaid`, `paymentMethod`, `reservationID`) VALUES
(52, '2024-07-03', 0, '', 9108),
(53, '2024-07-03', 0, '', 9109),
(54, '2024-07-03', 626, '', 9110),
(55, '2024-07-03', 0, '', 9110);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(11) NOT NULL,
  `NumOfAdult` int(11) NOT NULL,
  `NumOfChild` int(11) NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckOutDate` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `customerID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `NumOfAdult`, `NumOfChild`, `CheckInDate`, `CheckOutDate`, `status`, `customerID`, `employeeID`) VALUES
(9108, 1, 0, '2024-07-04', '2024-07-05', 'PAID', 1121, 0),
(9109, 1, 0, '2024-07-05', '2024-07-06', 'PAID', 1121, 0),
(9110, 1, 0, '2024-07-05', '2024-07-06', 'PAID', 1121, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

CREATE TABLE `reservationdetails` (
  `reserveID` int(11) NOT NULL,
  `price` double(10,0) NOT NULL,
  `reservationID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`reserveID`, `price`, `reservationID`, `roomID`) VALUES
(764, 840, 9108, 7095),
(765, 840, 9109, 7096),
(766, 626, 9110, 7097);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `roomType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomType`) VALUES
(7095, 'Premium Room'),
(7096, 'Premium Room'),
(7097, 'Deluxe Room Japanese');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `reservationID` (`reservationID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `employeeID` (`employeeID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  ADD PRIMARY KEY (`reserveID`),
  ADD KEY `reservationID` (`reservationID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1143;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9111;

--
-- AUTO_INCREMENT for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  MODIFY `reserveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=767;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7098;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
