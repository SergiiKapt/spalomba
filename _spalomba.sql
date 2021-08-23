-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: la391035.mysql.ukraine.com.ua
-- Generation Time: Aug 23, 2021 at 02:04 PM
-- Server version: 5.7.33-36-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `la391035_eurolombard`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  `info` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `role`, `info`, `created_at`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Super', 'Admin', 1, 'super star', '2021-08-18 15:37:46'),
(7, 'qq@qq.qq', '437599f1ea3514f8969f161a6606ce18', 'qqq', 'wwww', 0, 'eeeee', '2021-08-19 02:03:02'),
(8, 'admin@hhh.com', 'www', 'qqq', '', 0, '', '2021-08-19 02:11:57'),
(9, 'qw@qw', '', 'qw', 'qw', 0, 'qw', '2021-08-19 03:03:10'),
(13, 'qw@qw.qw', '', 'qw', 'qw', 0, 'qwwq', '2021-08-19 03:05:23'),
(14, 'qw@qw.qw6', '', 'qw', 'qw', 0, 'qwwq', '2021-08-19 03:06:09'),
(15, 'qw@qw.qw67', '', 'qw', 'qw', 0, 'qwwq', '2021-08-19 03:08:26'),
(16, 'qw@qw.q', '', 'qw', 'qw', 0, 'qwwq', '2021-08-19 03:09:04'),
(17, 'qw@qw.qpo', '', 'qw', 'qw', 0, 'qwwq', '2021-08-19 03:13:12'),
(19, 're@re', '12eccbdd9b32918131341f38907cbbb5', 're', 're', 0, 're', '2021-08-19 03:20:55'),
(20, 'vasya@coder.com', '0a113ef6b61820daa5611c870ed8d5ee', 'Vasiliy', 'Ivanov', 0, 'rrrrrrrrrr', '2021-08-19 17:48:23'),
(22, 'vasyaIvanov@coder.com', '5d9b2a1ee6586c626fee6a9fa23c0650', 'Vasiliy', 'Ivanov', 0, 'rrrrrrrrrr', '2021-08-19 19:26:13');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
