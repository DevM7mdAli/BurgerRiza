-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2025 at 03:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riza`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `restaurant_id`, `total`) VALUES
(1, 1, 1, 62.00),
(2, 2, 1, 25.00),
(3, 11, 5, 91.48),
(4, 13, 14, 57.80),
(5, 4, 18, 197.17),
(6, 9, 16, 147.12),
(7, 11, 8, 181.83),
(8, 17, 19, 193.32),
(9, 14, 14, 10.15),
(10, 11, 16, 58.84),
(11, 1, 1, 160.25),
(12, 14, 10, 77.50),
(13, 2, 15, 162.46),
(14, 7, 20, 45.21),
(15, 2, 18, 80.31),
(16, 3, 9, 158.59),
(17, 14, 5, 99.04),
(20, 20, 19, 126.07);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1),
(3, 2, 1, 1),
(6, 3, 32, 5),
(9, 5, 47, 1),
(11, 6, 33, 1),
(12, 6, 28, 5),
(13, 7, 23, 4),
(15, 8, 10, 2),
(17, 9, 50, 5),
(19, 10, 26, 1),
(20, 10, 40, 3),
(23, 12, 6, 5),
(26, 13, 43, 1),
(29, 15, 32, 4),
(32, 16, 22, 5),
(33, 17, 29, 4),
(39, 20, 3, 3),
(40, 20, 49, 4);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `order_id`, `user_id`, `restaurant_id`, `notes`, `total`) VALUES
(1, 1, 1, 1, 'No pickles please', 62.00),
(2, 2, 2, 1, 'Extra ketchup', 25.00),
(3, 16, 24, 30, 'asdasdasd', 911.00),
(4, 17, 24, 30, 'i want large', 911.00),
(5, 18, 24, 30, '', 957.00),
(6, 19, 24, 29, '', 122222.00),
(7, 20, 24, 1, '', 41.00),
(8, 24, 24, 29, '', 26.00),
(9, 25, 24, 30, '', 23.00),
(10, 26, 24, 1, '', 25.00),
(11, 30, 24, 1, '', 25.00),
(12, 31, 24, 30, 'sdfsdfsdfsdf', 23.00),
(13, 32, 24, 29, '', 122234.00),
(14, 33, 24, 30, '', 888.00),
(15, 34, 24, 29, 'this is the note', 122234.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `user_id`, `restaurant_id`, `total`, `created_at`) VALUES
(1, 1, 1, 62.00, '2025-04-23 18:29:42'),
(2, 2, 1, 25.00, '2025-04-23 18:29:42'),
(3, 19, 2, 257.84, '2025-04-25 06:38:19'),
(4, 9, 9, 244.57, '2025-04-25 06:38:19'),
(5, 7, 15, 276.61, '2025-04-25 06:38:19'),
(6, 5, 19, 45.60, '2025-04-25 06:38:19'),
(7, 1, 16, 264.64, '2025-04-25 06:38:19'),
(8, 1, 9, 57.89, '2025-04-25 06:38:19'),
(9, 5, 8, 159.41, '2025-04-25 06:38:19'),
(10, 19, 10, 119.98, '2025-04-25 06:38:19'),
(11, 1, 1, 31.16, '2025-04-25 06:38:19'),
(16, 24, 30, 911.00, '2025-04-26 11:42:51'),
(17, 24, 30, 911.00, '2025-04-27 06:52:38'),
(18, 24, 30, 957.00, '2025-04-27 07:48:01'),
(19, 24, 29, 122222.00, '2025-04-27 07:48:13'),
(20, 24, 1, 41.00, '2025-04-27 08:10:38'),
(24, 24, 29, 26.00, '2025-04-27 08:20:48'),
(25, 24, 30, 23.00, '2025-04-27 08:20:59'),
(26, 24, 1, 25.00, '2025-04-27 08:21:46'),
(30, 24, 1, 25.00, '2025-04-27 11:25:59'),
(31, 24, 30, 23.00, '2025-04-27 12:44:51'),
(32, 24, 29, 122234.00, '2025-04-27 12:45:30'),
(33, 24, 30, 888.00, '2025-04-28 06:46:17'),
(34, 24, 29, 122234.00, '2025-04-30 12:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `restaurant_id`, `img`, `time_created`) VALUES
(1, 'Classic Burger', 25.00, 49, 1, 'burger.jpg', '2025-04-23 18:29:42'),
(2, 'Cheese Fries', 12.00, 100, 1, 'fries.jpg', '2025-04-23 18:29:42'),
(3, 'Soft Drink', 5.00, 200, 1, 'drink.jpg', '2025-04-23 18:29:42'),
(4, 'Product_4', 25.16, 57, 1, 'img_4.jpg', '2025-04-25 06:34:07'),
(5, 'Product_5', 14.96, 93, 1, 'img_5.jpg', '2025-04-25 06:34:07'),
(6, 'Product_6', 28.39, 21, 2, 'img_6.jpg', '2025-04-25 06:34:07'),
(7, 'Product_7', 26.99, 73, 2, 'img_7.jpg', '2025-04-25 06:34:07'),
(8, 'Product_8', 6.34, 86, 2, 'img_8.jpg', '2025-04-25 06:34:07'),
(9, 'Product_9', 49.22, 47, 2, 'img_9.jpg', '2025-04-25 06:34:07'),
(10, 'Product_10', 16.50, 66, 2, 'img_10.jpg', '2025-04-25 06:34:07'),
(16, 'Product_16', 40.40, 37, 4, 'img_16.jpg', '2025-04-25 06:35:09'),
(17, 'Product_17', 32.83, 7, 4, 'img_17.jpg', '2025-04-25 06:35:09'),
(18, 'Product_18', 24.96, 84, 4, 'img_18.jpg', '2025-04-25 06:35:09'),
(19, 'Product_19', 18.10, 73, 4, 'img_19.jpg', '2025-04-25 06:35:09'),
(20, 'Product_20', 33.34, 100, 4, 'img_20.jpg', '2025-04-25 06:35:09'),
(21, 'Product_21', 15.02, 64, 5, 'img_21.jpg', '2025-04-25 06:35:09'),
(22, 'Product_22', 18.34, 95, 5, 'img_22.jpg', '2025-04-25 06:35:09'),
(23, 'Product_23', 34.08, 68, 5, 'img_23.jpg', '2025-04-25 06:35:09'),
(24, 'Product_24', 24.07, 18, 5, 'img_24.jpg', '2025-04-25 06:35:09'),
(25, 'Product_25', 15.65, 21, 5, 'img_25.jpg', '2025-04-25 06:35:09'),
(26, 'Product_26', 27.96, 91, 6, 'img_26.jpg', '2025-04-25 06:35:44'),
(27, 'Product_27', 42.51, 53, 6, 'img_27.jpg', '2025-04-25 06:35:44'),
(28, 'Product_28', 42.80, 62, 6, 'img_28.jpg', '2025-04-25 06:35:44'),
(29, 'Product_29', 45.77, 78, 6, 'img_29.jpg', '2025-04-25 06:35:44'),
(30, 'Product_30', 24.11, 81, 6, 'img_30.jpg', '2025-04-25 06:35:44'),
(31, 'Product_31', 26.41, 36, 7, 'img_31.jpg', '2025-04-25 06:35:44'),
(32, 'Product_32', 24.13, 57, 7, 'img_32.jpg', '2025-04-25 06:37:26'),
(33, 'Product_33', 15.05, 34, 7, 'img_33.jpg', '2025-04-25 06:37:26'),
(34, 'Product_34', 40.88, 87, 7, 'img_34.jpg', '2025-04-25 06:37:26'),
(35, 'Product_35', 16.58, 82, 7, 'img_35.jpg', '2025-04-25 06:37:26'),
(36, 'Product_36', 19.31, 51, 8, 'img_36.jpg', '2025-04-25 06:37:26'),
(37, 'Product_37', 19.14, 16, 8, 'img_37.jpg', '2025-04-25 06:37:26'),
(38, 'Product_38', 7.53, 51, 8, 'img_38.jpg', '2025-04-25 06:37:26'),
(39, 'Product_39', 17.33, 37, 8, 'img_39.jpg', '2025-04-25 06:37:26'),
(40, 'Product_40', 29.62, 68, 8, 'img_40.jpg', '2025-04-25 06:37:26'),
(41, 'Product_41', 27.03, 83, 9, 'img_41.jpg', '2025-04-25 06:37:26'),
(42, 'Product_42', 48.33, 74, 9, 'img_42.jpg', '2025-04-25 06:37:26'),
(43, 'Product_43', 39.12, 23, 9, 'img_43.jpg', '2025-04-25 06:37:26'),
(44, 'Product_44', 16.95, 96, 9, 'img_44.jpg', '2025-04-25 06:37:26'),
(45, 'Product_45', 11.38, 58, 9, 'img_45.jpg', '2025-04-25 06:37:26'),
(46, 'Product_46', 48.78, 15, 10, 'img_46.jpg', '2025-04-25 06:37:26'),
(47, 'Product_47', 5.28, 29, 10, 'img_47.jpg', '2025-04-25 06:37:26'),
(48, 'Product_48', 47.96, 77, 10, 'img_48.jpg', '2025-04-25 06:37:26'),
(49, 'Product_49', 20.90, 39, 10, 'img_49.jpg', '2025-04-25 06:37:26'),
(50, 'Product_50', 17.79, 63, 10, 'img_50.jpg', '2025-04-25 06:37:26'),
(51, 'Product_51', 36.30, 93, 11, 'img_51.jpg', '2025-04-25 06:37:26'),
(54, 'rrrrr', 12.00, 0, 29, 'uploads/product/warehouse2.jpg', '2025-04-25 14:41:25'),
(55, 'koko eat', 122222.00, 10, 29, 'uploads/product/warehouse_1.jpg', '2025-04-25 14:41:55'),
(56, 'hhh', 888.00, 6, 30, 'uploads/product/logo_4.png', '2025-04-25 19:54:31'),
(57, 'test', 23.00, 11, 30, 'uploads/product/logo_5.png', '2025-04-25 20:04:41'),
(58, 'this is a burger test', 12.00, 110, 29, 'uploads/product/3567284.png', '2025-04-30 12:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`, `phone`, `owner_id`, `img`) VALUES
(1, 'Khalid\'s Burgers', 'Riyadh, Main Street', '0551112233', 3, 'uploads/Logo.png'),
(2, 'Restaurant_2', 'Address_2', '+12934028719', 2, NULL),
(4, 'Restaurant_4', 'Address_4', '+19937846210', 4, NULL),
(5, 'Restaurant_5', 'Address_5', '+19522350328', 5, NULL),
(6, 'Restaurant_6', 'Address_6', '+17882265084', 6, NULL),
(7, 'Restaurant_7', 'Address_7', '+17209594216', 7, NULL),
(8, 'Restaurant_8', 'Address_8', '+17345523602', 8, NULL),
(9, 'Restaurant_9', 'Address_9', '+15849872499', 9, NULL),
(10, 'Restaurant_10', 'Address_10', '+14373042784', 10, NULL),
(11, 'Restaurant_11', 'Address_11', '+18012215509', 11, NULL),
(12, 'Restaurant_12', 'Address_12', '+13696606123', 12, NULL),
(13, 'Restaurant_13', 'Address_13', '+15491007657', 13, NULL),
(14, 'Restaurant_14', 'Address_14', '+17934515584', 14, NULL),
(15, 'Restaurant_15', 'Address_15', '+16185570852', 15, NULL),
(16, 'Restaurant_16', 'Address_16', '+13094400191', 16, NULL),
(17, 'Restaurant_17', 'Address_17', '+12090685675', 17, NULL),
(18, 'Restaurant_18', 'Address_18', '+14880773374', 18, NULL),
(19, 'Restaurant_19', 'Address_19', '+16663749316', 19, NULL),
(20, 'Restaurant_20', 'Address_20', '+15151021980', 20, NULL),
(21, 'll', 'asas', '12345', 22, NULL),
(29, 'ddd', 'ddd', '123123', 23, NULL),
(30, 'theGoat', 'dsfdf', '123123', 25, 'uploads/rest/warehouse2.jpg'),
(31, 'dsfsdfs', 'sfsdf', '123445', 28, 'uploads/rest/3567284.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `account_role` enum('customer','owner') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `email`, `password`, `avatar`, `phone`, `account_role`, `created_at`, `last_name`) VALUES
(1, 'Ali Ahmed', 'ali@example.com', 'hashed_pass1', 'avatar1.jpg', '0501234567', 'customer', '2025-04-23 18:29:42', ''),
(2, 'Fatima Noor', 'fatima@example.com', 'hashed_pass2', 'avatar2.jpg', '0509876543', 'customer', '2025-04-23 18:29:42', ''),
(3, 'Khalid Saleh', 'khalid@example.com', 'hashed_pass3', 'avatar3.jpg', '0551112233', 'owner', '2025-04-23 18:29:42', ''),
(4, 'asdasd', 'mo@mo.com', '788a1bdda48d89ba2031a949aa96cbc6', 'upload/warehouse2.jpg', '123', 'customer', '2025-04-24 12:45:41', 'sdasd'),
(5, 'ali', 'userr1@gmail.com', '788a1bdda48d89ba2031a949aa96cbc6', 'upload/logo.png', '123', 'customer', '2025-04-24 13:20:11', 'ali'),
(6, 'asdasd', 'test@gmail.com', '788a1bdda48d89ba2031a949aa96cbc6', 'uploads/logo.png', '1223', 'customer', '2025-04-24 13:24:24', 'asdasd'),
(7, 'aaa', 'aa@a.com', '788a1bdda48d89ba2031a949aa96cbc6', 'uploads/logo.png', '12123', 'owner', '2025-04-25 05:35:59', 'aaaa'),
(8, 'ss', 'v@v.com', '788a1bdda48d89ba2031a949aa96cbc6', 'uploads/warehouse2.jpg', '323', 'customer', '2025-04-25 05:38:03', 'ass'),
(9, 'Hank', 'hank.williams9@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_9.jpg', '+15478112497', 'owner', '2025-04-25 06:34:07', 'Williams'),
(10, 'Ivy', 'ivy.brown10@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_10.jpg', '+19711666083', 'customer', '2025-04-25 06:34:07', 'Brown'),
(11, 'Grace', 'grace.smith11@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_11.jpg', '+12836042116', 'customer', '2025-04-25 06:34:07', 'Smith'),
(12, 'Alice', 'alice.smith12@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_12.jpg', '+19610857521', 'customer', '2025-04-25 06:34:07', 'Smith'),
(13, 'Ivy', 'ivy.wilson13@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_13.jpg', '+19862141801', 'customer', '2025-04-25 06:34:07', 'Wilson'),
(14, 'Hank', 'hank.smith14@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_14.jpg', '+15417590513', 'customer', '2025-04-25 06:34:07', 'Smith'),
(15, 'Bob', 'bob.miller15@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_15.jpg', '+14897654411', 'owner', '2025-04-25 06:34:07', 'Miller'),
(16, 'Grace', 'grace.brown16@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_16.jpg', '+12032978605', 'customer', '2025-04-25 06:34:07', 'Brown'),
(17, 'Ivy', 'ivy.johnson17@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_17.jpg', '+18194861763', 'owner', '2025-04-25 06:34:07', 'Johnson'),
(18, 'Jack', 'jack.miller18@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_18.jpg', '+16096133642', 'customer', '2025-04-25 06:34:07', 'Miller'),
(19, 'Grace', 'grace.davis19@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_19.jpg', '+18420014635', 'customer', '2025-04-25 06:34:07', 'Davis'),
(20, 'Jack', 'jack.smith20@example.com', 'e10adc3949ba59abbe56e057f20f883e\n', 'avatar_20.jpg', '+17662627316', 'owner', '2025-04-25 06:34:07', 'Smith'),
(21, '111', 'a@w.com', 'd560e5dfc2282adfcd1e2bc66fca3787', 'uploads/warehouse.jpg', '123', 'owner', '2025-04-25 07:21:16', '111'),
(22, '11111', 'b@b.com', 'd560e5dfc2282adfcd1e2bc66fca3787', 'uploads/warehouse2.jpg', '123', 'owner', '2025-04-25 07:59:12', '111111'),
(23, '123', 'd@d.com', 'd560e5dfc2282adfcd1e2bc66fca3787', 'uploads/logo.png', '123', 'owner', '2025-04-25 09:39:37', '123'),
(24, 'ad', 'c@c.com', '788a1bdda48d89ba2031a949aa96cbc6', 'uploads/warehouse_1.jpg', '12345', 'customer', '2025-04-25 14:36:30', 'ass'),
(25, 'asads1', 'z@z.com', '74ba9c1d6eac9746c9a80c762649136e', 'uploads/warehouse2_1.jpg', '34532342', 'owner', '2025-04-25 19:37:19', 'dsadw21'),
(28, '111', 'userr23@gmail.com', 'd560e5dfc2282adfcd1e2bc66fca3787', 'uploads/3567284_1.png', '111111', 'owner', '2025-04-30 12:34:35', '1111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `owner_id` (`owner_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_table_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
