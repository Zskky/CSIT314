-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 15, 2023 at 09:52 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `bidId` int NOT NULL AUTO_INCREMENT,
  `wsId` int DEFAULT NULL,
  `bidderId` int DEFAULT NULL,
  `bidStatus` int DEFAULT NULL,
  `E_Name` varchar(100) DEFAULT NULL,
  `workName` varchar(100) NOT NULL,
  PRIMARY KEY (`bidId`),
  KEY `wsId` (`wsId`),
  KEY `bidderId` (`bidderId`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bidId`, `wsId`, `bidderId`, `bidStatus`, `E_Name`, `workName`) VALUES
(18, 47, 845, 1, 'cashier2', '2023-11-18, 08:30:00 to 17:00:00, staff, cashier'),
(19, 50, 845, 1, 'cashier2', '2023-12-31, 08:30:00 to 17:00:00, staff, cashier'),
(37, 47, 842, 1, 'cashier1', '2023-11-18, 08:30:00 to 17:00:00, staff, cashier'),
(38, 50, 842, 1, 'cashier1', '2023-12-31, 08:30:00 to 17:00:00, staff, cashier'),
(36, 47, 845, 1, 'cashier2', '2023-11-18, 08:30:00 to 17:00:00, staff, cashier');

-- --------------------------------------------------------

--
-- Table structure for table `uniprofile`
--

DROP TABLE IF EXISTS `uniprofile`;
CREATE TABLE IF NOT EXISTS `uniprofile` (
  `User_Id` int NOT NULL,
  `E_Name` varchar(100) NOT NULL,
  `Pass` varchar(10) NOT NULL,
  `uniRole` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `staffRole` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`User_Id`,`E_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `uniprofile`
--

INSERT INTO `uniprofile` (`User_Id`, `E_Name`, `Pass`, `uniRole`, `staffRole`) VALUES
(11, 'zekko', '456789', 'staff', 'waiter'),
(12, 'karinaBomb', '5555', 'owner', NULL),
(17, 'zennoverse', '489', 'staff', NULL),
(836, 'Kenzi', '1234', 'manager', NULL),
(837, 'Markie', '123456', 'sysAdmin', NULL),
(842, 'cashier1', '123', 'staff', 'cashier'),
(843, 'waiter1', '123', 'staff', 'waiter'),
(844, 'chef1', '123', 'staff', 'chef'),
(845, 'cashier2', '123', 'staff', 'cashier'),
(846, 'waiter2', '123', 'staff', 'waiter'),
(847, 'chef2', '123', 'staff', 'chef');

-- --------------------------------------------------------

--
-- Table structure for table `useracct`
--

DROP TABLE IF EXISTS `useracct`;
CREATE TABLE IF NOT EXISTS `useracct` (
  `User_Id` int NOT NULL AUTO_INCREMENT,
  `E_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PhoneNo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `D_O_B` date NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`User_Id`,`E_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=850 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `useracct`
--

INSERT INTO `useracct` (`User_Id`, `E_Name`, `PhoneNo`, `D_O_B`, `Email`) VALUES
(8, 'sowieHan', '12345678', '1996-12-31', '12345678@gmail.com'),
(9, 'zero', '85491789', '0000-00-00', 'ken@hotie.com'),
(10, 'SoniaSim', '58467852', '1987-05-31', 'orea@gmail.com'),
(11, 'zekko', '187653415', '1987-07-23', 'oooooo@hotmail.com'),
(12, 'karinaBomb', '87643219', '1950-12-09', 'kerira@hotmail.com'),
(13, 'stresstest', '000000000', '1990-05-21', 'stresstest@mbykmb.com'),
(17, 'zennoverse', '98456251', '1998-08-23', 'pokeverse@holy.com'),
(18, 'kikikiriya', '98732678', '1997-08-21', 'kirika@hotmail.com'),
(836, 'Kenzi', '85465213', '1995-07-31', 'poke@gmail.com'),
(837, 'Markie', '95745848', '0000-00-00', 'admin@gmail.com'),
(840, 'mark', '8563-2-31', '0000-00-00', 'hottie@lol.com'),
(842, 'cashier1', '1122334455', '1999-11-12', '123155325@1222.com'),
(843, 'waiter1', '12314123123', '1922-01-14', '12312412@12333.com'),
(844, 'chef1', '12341234522', '1990-12-31', '221341996@gmail.com'),
(845, 'cashier2', '245123', '1992-09-14', 'asdawe12@asa.com'),
(846, 'waiter2', '245123555', '1992-09-12', 'qwq231@hott.com'),
(847, 'chef2', '231245', '0000-00-00', '12312asd2@ffsawe.com');

-- --------------------------------------------------------

--
-- Table structure for table `workslot`
--

DROP TABLE IF EXISTS `workslot`;
CREATE TABLE IF NOT EXISTS `workslot` (
  `startTime` time NOT NULL,
  `staffRole` varchar(20) DEFAULT NULL,
  `workDate` date NOT NULL,
  `uniRole` varchar(20) NOT NULL,
  `endTime` time NOT NULL,
  `wsId` int NOT NULL AUTO_INCREMENT,
  `workName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sBid` int DEFAULT NULL,
  PRIMARY KEY (`wsId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `workslot`
--

INSERT INTO `workslot` (`startTime`, `staffRole`, `workDate`, `uniRole`, `endTime`, `wsId`, `workName`, `sBid`) VALUES
('08:30:00', 'chef', '2023-11-18', 'staff', '17:00:00', 45, '2023-11-18, 08:30:00 to 17:00:00, staff, chef', 0),
('08:30:00', 'waiter', '2023-11-18', 'staff', '17:00:00', 46, '2023-11-18, 08:30:00 to 17:00:00, staff, waiter', 0),
('08:30:00', 'cashier', '2023-11-18', 'staff', '17:00:00', 47, '2023-11-18, 08:30:00 to 17:00:00, staff, cashier', 0),
('08:30:00', 'chef', '2023-12-31', 'staff', '17:00:00', 48, '2023-12-31, 08:30:00 to 17:00:00, staff, chef', 0),
('08:30:00', 'waiter', '2023-12-31', 'staff', '17:00:00', 49, '2023-12-31, 08:30:00 to 17:00:00, staff, waiter', 0),
('08:30:00', 'cashier', '2023-12-31', 'staff', '17:00:00', 50, '2023-12-31, 08:30:00 to 17:00:00, staff, cashier', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `uniprofile`
--
ALTER TABLE `uniprofile`
  ADD CONSTRAINT `uniProfile_Fk1` FOREIGN KEY (`User_Id`,`E_Name`) REFERENCES `useracct` (`User_Id`, `E_Name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
