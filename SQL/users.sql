-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 07, 2024 at 01:18 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `ward_no` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `job_type` enum('Student','Employed') DEFAULT NULL,
  `college_name` varchar(255) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `post` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `created_at`, `avatar`, `full_name`, `district`, `municipality`, `ward_no`, `phone_number`, `job_type`, `college_name`, `level`, `subject`, `company_name`, `post`) VALUES
(6, 'user@gmail.com', 'user', '$2y$10$0Jpb5PRF./KMbhKkIppoAu3BiqfCqELR1dbH26K76hKarUZbHvHZO', '2024-08-26 10:07:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'nabarajacharya999@gmail.com', 'lognepal', '$2y$10$E08Qni47BlJTy4ok6ljeHeAbCoIGdVKFj7Tm2.ZtOXui74sy7Yh2S', '2024-08-27 11:34:59', '453993328_835736925290228_5008586666683923972_n.jpg', 'Nabaraj Acharya', 'Khotang ', 'Diktel Rupakot Municipality -', 1, '986-1404971', 'Student', 'Jana Bhawana Campus', '4rth sem ', 'IT', NULL, NULL),
(12, 'nabaraj999@gmail.com', 'nabu', '$2y$10$QlDnAHkjqb.DdXiEumnqa.IZTOOe4ABMSscZhXlxLD4irLstL9kee', '2024-08-30 10:53:50', '../uploads/454006840_835736838623570_5511820074504122693_n.jpg', 'Nabaraj Acharya ', 'Khotang ', 'Diktel Rupakot Municipality -1', 1, '986-1404971', 'Employed', '', '', '', 'no comapny', 'no post'),
(13, 'sghdanbms@gmail.com', 'tfshbamnc', '$2y$10$pqAz6G3gmfvDwhCbqAS96O0.aVbMD2gdq7vyMicrxsbMmgzWtj10i', '2024-09-02 02:50:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'nayanmhrzn11@gmail.com', 'hi', '$2y$10$B9JxUEpZhSgL7xZ1GPzL2ey5Y/5eTiCtm8eV2vfUVmqVN10Sb9LeC', '2024-10-26 03:37:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'er@gmail.com', 'wee', '$2y$10$drkWaK/4X9MSHmotjUgkbuOkyc.pWDkGVgepJawCmHGbBbR7VZWCK', '2024-11-06 03:35:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
