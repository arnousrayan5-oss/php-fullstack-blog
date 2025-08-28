-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2025 at 09:22 PM
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
-- Database: `youbeeblog1`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `subject`, `content`, `user_id`, `date_created`, `deleted_at`) VALUES
(8, 'edit test', 'trying to edit post', 11, '2025-08-20 01:31:02', NULL),
(9, 'Check', 'Checking posts also', 11, '2025-08-20 01:31:39', '2025-08-20 01:54:26'),
(11, 'chatgbt', 'ai chatbot testing edit', 13, '2025-08-20 01:35:34', '2025-08-20 01:36:50'),
(13, 'new post 2', 'new post by raed!', 12, '2025-08-20 02:18:40', NULL),
(14, 'trying to post', 'Hello world!', 10, '2025-08-20 02:55:13', '2025-08-20 21:16:41'),
(15, 'Test post2', 'hello youbee!\r\n', 10, '2025-08-20 21:16:59', NULL),
(16, 'delete this', 'test for deleting', 10, '2025-08-20 22:12:45', '2025-08-20 22:12:48'),
(17, 'post3', 'new post by raed ', 12, '2025-08-20 22:45:59', NULL),
(18, 'Whatsup!', 'Hello from youbee\r\n', 10, '2025-08-27 19:02:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL DEFAULT 'default.png',
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile`, `datecreated`) VALUES
(10, 'test2', 'test@gmail.com', '$2y$10$UW/cJlgfmXgIboFYzqReB.dK1xwM3pvxiLH/nTBf3/7HPNuZdt3Fa', 'img10_2176c66620192261d7bf.jpg', '2025-08-20 01:27:42'),
(11, 'Rayan ', 'rayan@gmail.com', '$2y$10$OVirBuc/acgOtEKTphm3G.fu4X7lE2w0iJ5azni.5KJ3xR5.JWmpO', 'default.png', '2025-08-20 01:30:20'),
(12, 'Raed A.', 'raed@gmail.com', '$2y$10$c02IIGdIS9Wx5Wliofy2muQKc/mfqBNSuUjTmPp8IF3OkMJCsSKsq', 'img12_66362a1649ede30599b2.jpg', '2025-08-20 01:32:52'),
(13, 'Rabih ', 'rabih@gmail.com', '$2y$10$amqZTCkFaZy2bUNgE/yX7uurOQWKESEVU6eyCu4MldfqhSrPnYVry', 'default.png', '2025-08-20 01:34:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
