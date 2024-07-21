-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3399
-- Generation Time: Jul 21, 2024 at 11:16 PM
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
  `burger_price` double NOT NULL,
  `Extras` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_added_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burgers`
--

INSERT INTO `burgers` (`id`, `burgerName`, `burger_price`, `Extras`, `quantity`, `email`, `user_added_id`, `created_at`) VALUES
(1, 'Burger 1010', 41, 'cheese , tomato', 12, 'SemiProgrammer@Semi.com', 1, '2024-06-28 19:15:56'),
(2, 'Burger Tee', 90, 'tomato, cheese', 1, 'tomato@t.com', 1, '2024-06-28 19:17:29'),
(3, 'myBurger', 40, 'tomato', 40, 'me@k.com', 1, '2024-06-29 08:39:33'),
(9, 'myBurger', 1, 'hi', 7, 'meghf@gm.com', 1, '2024-07-02 09:38:52'),
(26, 's', 147.213, 'sdfsdf', 2, 'r@r.r', 3, '2024-07-06 17:42:14'),
(28, 'sdfsdfsdfdf', 65.7532, 'extras', 4, 'r@r.r', 3, '2024-07-07 12:44:17'),
(29, 'sdfsdfsdfdf', 65.7532, 'extras', 6, 'm@m.m', 4, '2024-07-07 19:13:32'),
(30, 'saasdasd', 23, 'cheese', 0, 'Resturantr@r.r', 6, '2024-07-20 21:21:21'),
(31, 'saasdasd', 23, 'cheese', 10, 'Resturantr@r.r', 6, '2024-07-21 13:23:52'),
(32, 'dfgdfg', 123.13, 'fdgdfgdfg', 12, 'Resturantr@r.r', 6, '2024-07-21 13:32:12'),
(33, 'fhdfg', 12, 'dfsfdsf', 12, 'Resturantr@r.r', 6, '2024-07-21 13:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_cart_id` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `burger_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `burger_names` varchar(255) NOT NULL,
  `total price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `account_type` varchar(1) NOT NULL,
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

INSERT INTO `user` (`user_id`, `account_type`, `email`, `user_password`, `user_name`, `first_name`, `last_name`, `user_time_created`) VALUES
(1, 'R', 'test@g.com', '16d7a4fca7442dda3ad93c9a726597e4', 'TestMeBroXD', '', '', '2024-07-03 14:34:21'),
(2, 'R', 'rashed@rashed.rashed', 'd7343f5a66f733df361e219edd34f900', 'rowaished', 'rashed', 'sh', '2024-07-03 20:51:56'),
(3, 'R', 'r@r.r', '77bffc9ce3544fe5177da67c29a2efde', 'rare', 'rare', 'rarest', '2024-07-03 20:55:52'),
(4, 'R', 'm@m.m', '984cefd6d27eb0471fc401a493a4fdff', 'ml', 'mll', 'mlll', '2024-07-07 19:12:54'),
(5, 'C', 'Customer@c.c', '85862151eaed9bbc8b94373243e687cf', 'customer', 'customer', 'customer', '2024-07-19 17:28:34'),
(6, 'R', 'Resturantr@r.r', '18d6b8187e17e14986377e9ce252beb6', 'Resturantr', 'Resturantr', 'Resturantr', '2024-07-19 17:29:28');

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
