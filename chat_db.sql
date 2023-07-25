-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 06:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(55, 12, 11, ' hi', 1, '2023-07-01 10:42:08'),
(56, 11, 12, ' nn', 1, '2023-07-01 10:42:29'),
(57, 12, 11, ' nn', 1, '2023-07-01 10:45:15'),
(58, 12, 11, ' nn', 1, '2023-07-01 10:45:16'),
(59, 12, 11, 'hllo', 1, '2023-07-01 10:45:23'),
(60, 11, 12, 'thank you', 1, '2023-07-01 10:45:33'),
(61, 12, 11, ' oky', 1, '2023-07-01 11:08:22'),
(62, 11, 12, ' fine!\n', 1, '2023-07-01 11:08:39'),
(63, 11, 10, ' hello', 1, '2023-07-01 11:12:21'),
(64, 11, 10, 'hi pro', 1, '2023-07-01 11:14:18'),
(65, 11, 10, ' nn', 1, '2023-07-01 18:32:17'),
(66, 11, 12, ' b', 1, '2023-07-01 18:45:05'),
(67, 10, 11, 'love you', 1, '2023-07-03 12:04:28'),
(68, 11, 12, ' vvv', 1, '2023-07-03 12:05:03'),
(69, 12, 11, ' love you\n', 1, '2023-07-03 12:05:52'),
(70, 11, 12, 'me too', 1, '2023-07-03 12:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `conversetion`
--

CREATE TABLE `conversetion` (
  `id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `conversetion`
--

INSERT INTO `conversetion` (`id`, `user_1`, `user_2`) VALUES
(1, 11, 12),
(2, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `p-p` varchar(255) NOT NULL DEFAULT 'user.jpg',
  `lastseen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `password`, `p-p`, `lastseen`) VALUES
(10, 'qasem', 'qasem2', '$2y$10$1AprYktXVTI.pgzP9G2Q3.FGEiJGnvH5UbHqh1zHGV06gXrIMo0VC', 'qasem2.jpg', '2023-07-03 12:05:16'),
(11, 'yousef', 'yousef', '$2y$10$eU8x.MgjjIm2WHZoByF7cui37I7LyuPjnvjTrsoBiNkvi5OT6Ocri', 'yousef.jpg', '2023-07-11 12:26:44'),
(12, 'zainab', 'zainab1', '$2y$10$jDodjp3XF3KPZJkSA8iSdO/zXecneUxruKxIgHYYKjeKCDxzmI2N2', 'zainab1.png', '2023-07-09 11:08:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `conversetion`
--
ALTER TABLE `conversetion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `conversetion`
--
ALTER TABLE `conversetion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
