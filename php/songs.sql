-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 15, 2024 at 02:15 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `lyrics` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `lyrics`, `created_at`, `updated_at`) VALUES
(1, 'Your Song', 'Parokya Ni Edgar', 'It took one look\r\nAnd forever laid out in front of me\r\nOne smile and I died\r\nOnly to be revived by you\r\n\r\nThere i was\r\nThought i had everything figured out\r\nGoes to show just how much i know\r\n\'bout the way life plays out...\r\n\r\nChorus:\r\nI take one step away\r\nbut i find myself coming back to you\r\nMy one and only, one and only you...ooh...\r\n\r\nNow i know\r\nThat i know not a thing at all\r\nExcept the fact that i am yours\r\nAnd that you are mine\r\n\r\nOoh\r\nThey told me that this wouldn\'t be easy\r\nAnd no\r\nI\'m not one to complain...\r\n\r\nI take one step away\r\nthen i find myself coming back to you\r\nMy one and only, one and only you\r\n\r\nI take one step away\r\nbut i find myself coming back to you\r\nMy one and only, one and only you…', '2024-01-15 14:15:13', '2024-01-15 14:15:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
