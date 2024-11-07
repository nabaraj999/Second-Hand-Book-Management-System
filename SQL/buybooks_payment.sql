-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 07, 2024 at 01:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booknest`
--

-- --------------------------------------------------------

--
-- Table structure for table `buybooks_payment`
--

CREATE TABLE `buybooks_payment` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `reference_code` varchar(50) DEFAULT NULL,
  `bookname` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `book_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buybooks_payment`
--

INSERT INTO `buybooks_payment` (`name`, `email`, `phone`, `reference_code`, `bookname`, `amount`, `created_at`, `status`, `book_id`, `id`) VALUES
('nabaraj', 'nayanmhrzn11@gmail.com', '97667890', '123123', 'Operating system', 12345.00, '2024-08-25 13:29:24', 'Accepted', NULL, 1),
('test', 'nabarajacharya999@gmail.com', '97667890', '123123', 'Operating system', 12345.00, '2024-08-25 15:26:49', 'Rejected', NULL, 3),
('test', 'nabaraj999@gmail.com', '97667890', '123123', 'Operating system', 12345.00, '2024-08-26 03:28:55', 'Rejected', 3, 5),
('test', 'nabaraj999@gmail.com', '97667890', '123123', 'Operating system', 12345.00, '2024-08-26 03:30:57', 'Accepted', 3, 6),
('test', 'nayanmhrzn11@gmail.com', '97667890', '123123', 'DBMS', 490.00, '2024-08-26 03:37:03', 'Rejected', 4, 7),
('nabaraj', 'nabarajacharya999@gmail.com', '97667890', '123123', 'Operating system', 123.00, '2024-08-26 03:56:43', 'Accepted', 1, 8),
('nabaraj', 'sangamtimalsina55@gmail.com', '97667890', '123123', 'Operating system', 120.00, '2024-08-27 04:53:56', 'Rejected', 6, 9),
('nabaraj', 'nabarajacharya999@gmail.com', '97667890', '123123', 'DBMS', 200.00, '2024-08-29 01:28:18', 'Accepted', 9, 10),
('nabaraj', 'nayanmhrzn11@gmail.com', '97667890', '123123', 'Operating system', 120.00, '2024-08-29 13:23:01', 'Pending', 10, 11),
('nabaraj', 'nayanmhrzn11@gmail.com', '97667890', '123123', 'Operating system', 120.00, '2024-08-29 13:24:23', 'Pending', 10, 12),
('nabu', 'nabarajacharya999@gmail.com', '9861404971', '53223', 'Operating system', 120.00, '2024-08-30 12:38:33', 'Accepted', 12, 13),
('nabu', 'nabaraj999@gmail.com', '97667890', '53223', 'OOPS in java ', 450.00, '2024-08-31 04:45:19', 'Pending', 11, 16),
('lognepal', 'nayanmhrzn11@gmail.com', '9861404971', '53223', 'Operating system', 124.00, '2024-09-01 04:11:18', 'Pending', 14, 17),
('lognepal', 'nabaraj999@gmail.com', '97667890', '53223', 'OOPS in java ', 120.00, '2024-09-02 07:38:56', 'Pending', 13, 18),
('lognepal', 'nayanmhrzn11@gmail.com', '9861404971', '53223', NULL, 300.00, '2024-09-03 13:17:28', 'Pending', 3, 19),
('lognepal', 'nayanmhrzn11@gmail.com', '9861404971', '86552', NULL, 300.00, '2024-09-03 13:23:34', 'Pending', 3, 20),
('nabu', 'nabaraj999@gmail.com', '9861404971', '53223', NULL, 1499.00, '2024-09-03 13:49:34', 'Pending', 1, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buybooks_payment`
--
ALTER TABLE `buybooks_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buybooks_payment`
--
ALTER TABLE `buybooks_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
