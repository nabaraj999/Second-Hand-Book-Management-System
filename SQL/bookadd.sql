-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 07, 2024 at 01:16 PM
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
-- Table structure for table `bookadd`
--

CREATE TABLE `bookadd` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `published_date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `language` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookadd`
--

INSERT INTO `bookadd` (`id`, `title`, `author`, `isbn`, `price`, `discount`, `published_date`, `category`, `cover`, `description`, `created_at`, `language`, `pages`) VALUES
(8, 'सपना र यथार्थमा अमेरिका', 'Sanu Babu silwal ', '9937148146', 289.00, 0.00, '2024-11-01', 'Novel', '../uploads/American Dream.jpg', 'It’s about financial freedom, maintaining prosperous lives, and following the path of economic prosperity. Book as a guide and lead for those who have been living in the USA and those who will be willing to come in. You can find any information in the book on how to prosper. Book the information about the USA, challenges, problems, and opportunities. It is about respecting hard work, making seed money, and investing in entrepreneurship.', '2024-11-07 11:51:32', 'Nepali', 283),
(9, 'Phoolko Aankhaama', 'Ani choying Drolma', '9789937874090', 500.00, 0.00, '2018-07-11', 'Educational', '../uploads/phoolko Ankhama.jpg', 'Ani Choying Drolma was born in Bouddha. Her childhood was full of suffering and she grew up with much pain and complexity. To get rid of the pain due to her father\'s death, she went into a monastery and later became a Buddhist nun. She learnt spiritualism, monasticism, and the meaning of loyalty, truth, patience and forgiveness. Today, she stands as a leading role of peace and harmony in the world. This autobiography is the twelfth translation of the original French edition.', '2024-11-07 11:56:25', 'Nepali', 273),
(10, 'जीवनको छेउबाट', 'Suman Pokhrel ', ' 978-9937-734', 250.00, 0.00, '2020-05-19', 'Educational', '../uploads/57721484.jpg', '\"Jeevanko Chheubaata\" is a collection of poems written by Suman Pokhrel. This collection includes forty-two modern Nepali poems. The book was awarded the Best Book of the Year in 2066 BS by the Jayendra Prasai Foundation.\r\n\r\nIn the preface of the book, critic Abhi Subedi interprets the included poems from the perspective of alternative modernity. Several poems from this collection have been translated into various languages, including English, Italian, Spanish, German, Arabic, Georgian, Russian, Bengali, Hindi, Vietnamese, and Persian, among others, and have been featured in international literary magazines and anthologies.\r\n\r\nA poem titled \"Tajmahal ra Mero Prem\" (trans. The Tajmahal and My Love) from this collection has been included in the curriculum of the Bachelor of Arts program at Purbanchal University, Nepal. The English translation of the same poem has been included in the curriculum of the Master of Arts in English program at Cauvery College for Women, an autonomous college in Tamil Nadu, India.\r\n\r\nThe English translation of another poem, \"Timi Jasari Chheu\" (trans. You are as You are), from this collection has been included in the curriculum of the M.A. Degree Programme in English Language and Literature at the University of Kerala in Kerala and the MA in English Literature at GD Goenka University in New Delhi, India.\r\n\r\nFrench admirer Andrea Fernandez has tattooed excerpts from two poems, \"Khorampa\" and \"Byastata,\" from this collection on her arm.\r\n', '2024-11-07 12:04:46', 'Nepali', 110),
(11, 'एकादेशमा [Ekadeshma]', 'Sanu Sharma ', '9789937708371', 430.00, 0.00, '2022-06-14', 'Biography', '../uploads/54298149.jpg', 'No', '2024-11-07 12:07:03', 'Nepali', 273),
(12, 'तीन घुम्ती [Teen Ghumti]', 'Bishweshwar koirala ', '9993328944', 190.00, 0.00, '2019-11-12', 'Fantasy', '../uploads/13722772.jpg', 'Set during the Panchayat regime, it is the story of a Newar girl of Kathmandu Indramaya (Garima Panta), who falls in love with Pitambar (Dhruba Dutta), from a Brahmin family. Though inter-caste marriage was not socially and culturally acceptable then, the duo get married. Also a political activist, Pitambar is then jailed for going against the Panchayat System and the king.', '2024-11-07 12:11:11', 'Nepali', 74),
(13, 'चिना हराएको मान्छे', 'Haribanksha Acharya ', ' 978993786664', 450.00, 0.00, '2018-08-01', 'Biography', '../uploads/17878202.jpg', 'हरिवंश आचार्य नाम नै एउटा महत्वपूर्ण परिचय हो । संसारमा विरलै कोही नेपाली होलान्, जसलाई उनका बारेमा थाहा नभएको होस् । संसारमा विरलै नेपाली होलान्, जसलाई उनका बारमा सबै कुरा थाहा भएको होस् । रङ्गमञ्च र पर्दाका माध्यमबाट त उनलाई प्रायः सबैले देखेका र चिनेका छन् । उनी असल र महान् कलाकार मात्र होइनन् बेलाबेलामा भएका महत्वपूर्ण राजनीतिक तथा सामाजिक परिवर्तनका अभियन्ता पनि हुन् । यस्ता बहुआयामिक व्यक्तित्वको जीवन कस्तो छ ? अभिनय गरेर अरुलाई पेट मिचीमिची हसाउने र धरधरी रुवाउन पनि सक्ने यी महान् कलाकार आफ्नो वास्तविक जीवनमा कति हासेका छन् र कति रोएका छन् त ? यस्ता अनेक प्रसङ्गहरुको बेलिबिस्तार चिना हराएको मान्छे पुस्तकमा छन् । यो पुस्तक पढेपछि हामी उनलाई आफ्नो सबैभन्दा नजिकको आफन्तलाई झैँ चिन्नेछौँ ।', '2024-11-07 12:13:28', 'Nepali', 294);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookadd`
--
ALTER TABLE `bookadd`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookadd`
--
ALTER TABLE `bookadd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
