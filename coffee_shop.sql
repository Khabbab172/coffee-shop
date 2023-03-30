-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 12:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` bigint(100) NOT NULL,
  `quantity` bigint(100) NOT NULL,
  `total_amt` bigint(100) NOT NULL,
  `is_refund` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 => no\r\n1 => yes\r\n',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `product_name`, `product_price`, `quantity`, `total_amt`, `is_refund`, `created_at`, `updated_at`) VALUES
(1, 14, 8, 'cold coffee', 40, 2, 80, '0', '2023-03-30 10:46:32', '2023-03-30 08:21:45'),
(2, 14, 8, 'cold coffee', 20, 9, 180, '0', '2023-03-30 05:22:06', '2023-03-30 08:21:52'),
(3, 14, 9, 'Cappacino', 40, 3, 120, '0', '2023-03-30 05:25:32', '2023-03-30 08:21:56'),
(4, 14, 8, 'cold coffee', 20, 2, 40, '0', '2023-03-30 05:33:37', '2023-03-30 05:33:37'),
(5, 14, 8, 'cold coffee', 20, 2, 40, '0', '2023-03-30 05:36:47', '2023-03-30 05:36:47'),
(6, 14, 8, 'cold coffee', 20, 2, 40, '0', '2023-03-30 05:37:07', '2023-03-30 05:37:07'),
(7, 14, 9, 'Cappacino', 40, 1, 40, '0', '2023-03-30 05:54:42', '2023-03-30 05:54:42'),
(8, 7, 8, 'cold coffee', 20, 1, 20, '0', '2023-03-30 05:55:55', '2023-03-30 05:55:55'),
(9, 7, 8, 'cold coffee', 20, 1, 20, '0', '2023-03-30 05:55:58', '2023-03-30 05:55:58'),
(10, 7, 8, 'cold coffee', 20, 1, 20, '0', '2023-03-30 05:58:17', '2023-03-30 05:58:17'),
(11, 14, 8, 'cold coffee', 20, 5, 100, '1', '2023-03-30 08:23:03', '2023-03-30 08:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` bigint(100) NOT NULL,
  `product_pic` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_pic`, `created_at`, `updated_at`) VALUES
(8, 'cold coffee', 20, '1680121202.jpg', '2023-03-29 05:53:27', '2023-03-29 20:20:02'),
(9, 'Cappacino', 40, '1680120900.jpg', '2023-03-29 20:14:37', '2023-03-29 20:15:00'),
(10, 'kopiluwak', 30, '1680121058.jpg', '2023-03-29 20:17:38', '2023-03-29 20:17:38'),
(11, 'frapicino', 30, '1680121102.jpg', '2023-03-29 20:18:22', '2023-03-29 20:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT 2 COMMENT '1 for admin\r\n2 for customer',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` bigint(100) NOT NULL,
  `wallet` bigint(100) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `name`, `email`, `password`, `phone`, `wallet`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@demo.com', '12345', 7777777779, 0, NULL, '2023-03-29 02:50:16', '2023-03-29 02:50:16'),
(2, 2, 'John Doe', 'john@gmail.com', '12345', 0, 0, NULL, '2023-03-28 08:36:05', '2023-03-28 08:36:05'),
(3, 2, 'moiz', 'moiz@gmail.com', '12345', 0, 0, NULL, '2023-03-28 08:41:54', '2023-03-28 08:41:54'),
(4, 2, 'mak', 'm@mail.com', '12345', 0, 0, NULL, '2023-03-28 08:41:54', '2023-03-28 08:41:54'),
(5, 2, 'Khabbab', 'L@gmail.com', '12345', 8888888888, 0, NULL, '2023-03-28 15:16:12', '2023-03-28 15:16:12'),
(6, 2, 'ahmedmou', 'khabbab_@gmail.com', '12345', 7777777777, 0, '1680117021.png', '2023-03-28 15:30:04', '2023-03-29 19:10:21'),
(7, 2, 'rahil', 'a@gmail.com', '12345', 5555555555, 0, NULL, '2023-03-28 15:52:55', '2023-03-28 15:52:55'),
(8, 2, 'Khabbab', 'gg@gmail.com', '12345', 7777777777, 0, NULL, '2023-03-28 17:58:20', '2023-03-28 17:58:20'),
(9, 2, 'ahmedmou', 'yt@gmail.com', '12345', 7777777778, 0, NULL, '2023-03-28 18:01:31', '2023-03-28 18:01:31'),
(11, 2, 'ahmedmou', 'dmoeez94@gmail.com', '12345', 3333333333, 0, NULL, '2023-03-28 18:11:12', '2023-03-28 18:11:12'),
(12, 2, 'ahmedmou', 'ez94@gmail.com', '12345', 3333333333, 0, NULL, '2023-03-28 18:16:28', '2023-03-28 18:16:28'),
(13, 2, 'kha', 'z94@gmail.com', '12345', 6666666666, 0, NULL, '2023-03-28 18:18:41', '2023-03-28 18:18:41'),
(14, 2, 'khabhh', 'ahmedmoeez94@gmail.com', '12345', 6666666666, 1120, '1680116178.png', '2023-03-28 18:22:33', '2023-03-30 08:23:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
