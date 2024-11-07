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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `seller_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `book_category` varchar(50) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `book_name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `wallet_name` varchar(100) DEFAULT NULL,
  `wallet_number` varchar(50) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `payment_reference` varchar(50) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `seller_name`, `email`, `book_category`, `level`, `class`, `book_name`, `author`, `price`, `discount`, `isbn`, `photo`, `description`, `payment_method`, `bank_name`, `account_number`, `wallet_name`, `wallet_number`, `qr_code`, `payment_reference`, `status`) VALUES
(17, 'nabu', 'nabus@gmail.com', 'Literature', '', '', 'Java', 'Nabus', 1200.00, 10, '3736478621', '../uploads/Boom Box3JBL.jpg', 'abx', '', NULL, NULL, NULL, NULL, NULL, NULL, 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
