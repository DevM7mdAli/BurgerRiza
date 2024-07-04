-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3399
-- Generation Time: Jul 04, 2024 at 01:29 PM
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
-- Database: `burgerriza`
--

-- --------------------------------------------------------

--
-- Table structure for table `burgers`
--

CREATE TABLE `burgers` (
  `id` int(11) NOT NULL,
  `burgerName` varchar(255) NOT NULL,
  `Extras` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_added_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burgers`
--

INSERT INTO `burgers` (`id`, `burgerName`, `Extras`, `email`, `user_added_id`, `created_at`) VALUES
(1, 'Burger 1010', 'cheese , tomato', 'SemiProgrammer@Semi.com', 1, '2024-06-28 19:15:56'),
(2, 'Burger Tee', 'tomato, cheese', 'tomato@t.com', 1, '2024-06-28 19:17:29'),
(3, 'myBurger', 'tomato', 'me@k.com', 1, '2024-06-29 08:39:33'),
(9, 'myBurger', 'hi', 'meghf@gm.com', 1, '2024-07-02 09:38:52'),
(11, 'hdfgdgdfg', 'dfgdfgdfg', 'test@g.com', 1, '2024-07-02 16:05:55'),
(20, 'hello burger', 'tomato', 'test@g.com', 1, '2024-07-03 20:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `user_password`, `user_name`, `first_name`, `last_name`, `user_time_created`) VALUES
(1, 'test@g.com', '16d7a4fca7442dda3ad93c9a726597e4', 'TestMeBroXD', '', '', '2024-07-03 14:34:21'),
(2, 'rashed@rashed.rashed', 'd7343f5a66f733df361e219edd34f900', 'rowaished', 'rashed', 'sh', '2024-07-03 20:51:56'),
(3, 'r@r.r', '77bffc9ce3544fe5177da67c29a2efde', 'rare', 'rare', 'rarest', '2024-07-03 20:55:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `burgers`
--
ALTER TABLE `burgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_burgers_to_user` (`user_added_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `burgers`
--
ALTER TABLE `burgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `burgers`
--
ALTER TABLE `burgers`
  ADD CONSTRAINT `fk_burgers_to_user` FOREIGN KEY (`user_added_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
