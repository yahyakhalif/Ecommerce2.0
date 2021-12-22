-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 08:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

CREATE DATABASE yahya_ecommerce;
USE yahya_ecommerce;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `is_deleted`) VALUES
(1, 'Men', 0),
(2, 'Women', 0),
(3, 'Children', 0),
(4, 'Pets', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_amount` double DEFAULT 0,
  `order_status` enum('pending','pending payment','paid') DEFAULT 'pending',
  `payment_type` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `order_amount`, `order_status`, `payment_type`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 8, 2850, 'pending payment', 1, '2021-12-04 14:52:08', '2021-12-13 15:48:03', 0),
(2, 8, 1200, 'paid', 1, '2021-12-05 06:43:49', '2021-12-13 19:06:49', 0),
(3, 8, 4900, 'paid', 1, '2021-12-08 14:47:38', '2021-12-13 19:05:55', 0),
(4, 8, 5200, 'pending', 1, '2021-12-11 15:17:04', '2021-12-11 15:17:04', 0),
(5, 8, 1200, 'pending', 1, '2021-12-15 05:56:19', '2021-12-15 05:56:20', 0),
(6, 1, 3300, 'pending payment', 2, '2021-12-15 06:06:20', '2021-12-15 06:08:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `orderdetails_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double DEFAULT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `orderdetails_total` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`orderdetails_id`, `order_id`, `product_id`, `product_price`, `order_quantity`, `orderdetails_total`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 2, 2, 1200, 1, 1200, '2021-12-05 06:43:50', '2021-12-05 06:43:50', 0),
(2, 3, 2, 1200, 2, 2400, '2021-12-08 14:47:38', '2021-12-08 14:47:38', 0),
(3, 3, 1, 800, 2, 1600, '2021-12-08 14:47:38', '2021-12-08 14:47:38', 0),
(4, 3, 3, 300, 3, 900, '2021-12-08 14:47:38', '2021-12-08 14:47:38', 0),
(5, 4, 2, 1200, 3, 3600, '2021-12-11 15:17:04', '2021-12-11 15:17:04', 0),
(6, 4, 1, 800, 2, 1600, '2021-12-11 15:17:04', '2021-12-11 15:17:04', 0),
(7, 5, 2, 1200, 1, 1200, '2021-12-15 05:56:19', '2021-12-15 05:56:19', 0),
(8, 6, 2, 1200, 2, 2400, '2021-12-15 06:06:20', '2021-12-15 06:06:20', 0),
(9, 6, 3, 300, 3, 900, '2021-12-15 06:06:20', '2021-12-15 06:06:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paymenttypes`
--

CREATE TABLE `tbl_paymenttypes` (
  `paymenttype_id` int(11) NOT NULL,
  `paymenttype_name` varchar(20) NOT NULL,
  `description` varchar(40) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_paymenttypes`
--

INSERT INTO `tbl_paymenttypes` (`paymenttype_id`, `paymenttype_name`, `description`, `is_deleted`) VALUES
(1, 'Wallet', 'Money Loaded to the Digital Wallet', 0),
(2, 'M-Pesa', 'Mobile money option for Safaricom users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productimages`
--

CREATE TABLE `tbl_productimages` (
  `productimages_id` int(11) NOT NULL,
  `product_image` varchar(40) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_productimages`
--

INSERT INTO `tbl_productimages` (`productimages_id`, `product_image`, `product_id`, `created_at`, `updated_at`, `added_by`, `is_deleted`) VALUES
(1, '1638705156_0a9040b96c52607d960f.jpg', 1, '2021-12-05 05:52:36', '2021-12-05 05:52:36', 3, 0),
(2, '1638706961_00b3d7e45ecf9c7b1d2c.jpg', 2, '2021-12-05 06:22:41', '2021-12-05 06:22:41', 3, 0),
(3, '1638707094_fd3962a67521bede3109.jpg', 3, '2021-12-05 06:24:54', '2021-12-05 06:24:54', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_image` varchar(40) DEFAULT NULL,
  `unit_price` double NOT NULL,
  `available_quantity` int(11) DEFAULT 10,
  `subcategory_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_description`, `product_image`, `unit_price`, `available_quantity`, `subcategory_id`, `created_at`, `updated_at`, `added_by`, `is_deleted`) VALUES
(1, 'Track Suit', 'For all the Gym Fanatics!', '1638705156_0a9040b96c52607d960f.jpg', 800, 10, 3, '2021-12-05 05:52:36', '2021-12-05 05:52:36', 3, 0),
(2, 'Denim Jacket', 'Looking cute', '1638706961_00b3d7e45ecf9c7b1d2c.jpg', 1200, 10, 2, '2021-12-05 06:22:41', '2021-12-05 06:22:41', 3, 0),
(3, 'White Tee', 'It\'s Vogue', '1638707094_fd3962a67521bede3109.jpg', 300, 10, 12, '2021-12-05 06:24:54', '2021-12-05 06:24:54', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(15) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`, `is_deleted`) VALUES
(1, 'Admin', 0),
(2, 'User', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategories`
--

CREATE TABLE `tbl_subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(25) NOT NULL,
  `category` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategories`
--

INSERT INTO `tbl_subcategories` (`subcategory_id`, `subcategory_name`, `category`, `is_deleted`) VALUES
(1, 'Formal', 1, 0),
(2, 'Casual', 1, 0),
(3, 'Sports', 1, 0),
(4, 'Sports', 2, 0),
(5, 'Formal', 2, 0),
(6, 'Formal', 3, 0),
(7, 'Casual', 3, 0),
(8, 'Sports', 3, 0),
(9, 'Dogs', 4, 0),
(10, 'Cats', 4, 0),
(11, 'Other', 4, 0),
(12, 'Casual', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlogins`
--

CREATE TABLE `tbl_userlogins` (
  `userlogin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(25) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userlogins`
--

INSERT INTO `tbl_userlogins` (`userlogin_id`, `user_id`, `user_ip`, `login_time`, `logout_time`, `is_deleted`) VALUES
(1, 3, '::1', '2021-12-04 04:45:11', '2021-12-04 04:45:31', 0),
(2, 3, '::1', '2021-12-04 04:47:39', '2021-12-04 04:47:45', 0),
(3, 8, '::1', '2021-12-04 04:51:55', '2021-12-04 14:15:04', 0),
(4, 3, '::1', '2021-12-04 14:16:52', NULL, 0),
(5, 8, '::1', '2021-12-04 12:21:06', '2021-12-04 21:22:12', 0),
(6, 8, '::1', '2021-12-04 21:26:46', '2021-12-05 00:19:56', 0),
(7, 3, '::1', '2021-12-05 00:20:05', '2021-12-04 15:20:05', 0),
(8, 3, '::1', '2021-12-05 14:51:05', '2021-12-05 15:43:10', 0),
(9, 8, '::1', '2021-12-05 15:43:19', '2021-12-05 15:45:25', 0),
(10, 3, '::1', '2021-12-07 23:01:06', '2021-12-07 14:01:06', 0),
(11, 3, '::1', '2021-12-08 09:36:50', '2021-12-08 09:54:19', 0),
(12, 8, '::1', '2021-12-08 09:54:32', '2021-12-08 00:54:32', 0),
(13, 8, '::1', '2021-12-08 15:46:37', '2021-12-08 16:10:47', 0),
(14, 8, '::1', '2021-12-08 16:10:57', '2021-12-08 07:10:57', 0),
(15, 8, '::1', '2021-12-08 23:23:48', '2021-12-08 23:51:06', 0),
(16, 8, '::1', '2021-12-11 23:12:09', '2021-12-12 00:17:10', 0),
(17, 8, '::1', '2021-12-13 23:25:22', '2021-12-13 23:25:48', 0),
(18, 3, '::1', '2021-12-13 23:26:27', '2021-12-14 00:54:16', 0),
(19, 8, '::1', '2021-12-14 00:54:31', '2021-12-13 15:54:31', 0),
(20, 8, '::1', '2021-12-14 03:48:05', '2021-12-13 18:48:05', 0),
(21, 3, '::1', '2021-12-14 15:15:37', '2021-12-14 15:32:53', 0),
(22, 8, '::1', '2021-12-14 15:33:06', '2021-12-14 15:33:26', 0),
(23, 3, '::1', '2021-12-14 15:33:34', '2021-12-14 16:17:49', 0),
(24, 3, '::1', '2021-12-14 16:18:07', '2021-12-14 16:18:11', 0),
(25, 8, '::1', '2021-12-14 16:18:19', '2021-12-14 07:18:19', 0),
(26, 8, '::1', '2021-12-15 14:42:52', '2021-12-15 15:04:30', 0),
(27, 14, '::1', '2021-12-15 15:05:05', '2021-12-15 15:05:34', 0),
(28, 1, '::1', '2021-12-15 15:05:53', '2021-12-15 15:06:52', 0),
(29, 14, '::1', '2021-12-15 15:07:05', '2021-12-15 15:08:35', 0),
(30, 1, '::1', '2021-12-15 15:09:09', '2021-12-15 06:09:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `role` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `gender`, `role`, `is_deleted`) VALUES
(1, 'Dan', 'Roy', 'droy@gmail.com', '1234', 'male', 2, 0),
(2, 'Leon', 'Balogun', 'leoBalogun@gmail.com', '1234', 'male', 2, 0),
(3, 'Phil', 'Nyaga', 'phil@gmail.com', '1234', 'male', 1, 0),
(8, 'Katsuji', 'Nakashi', 'katsuji@gmail.com', '1234', 'male', 2, 0),
(9, 'Mike', 'Muya', 'muya@gmail.com', '1234', 'male', 2, 0),
(10, 'Andy', 'Kibe', 'andy@gmail.com', '1234', 'male', 2, 0),
(11, 'Snoop', 'Dogg', 'snoop@dogg.com', '4567', 'male', 2, 0),
(12, 'Lewis', 'Nyaga', 'lewis@gmail.com', '456', 'male', 1, 0),
(13, 'Jobs', 'Nyaga', 'jobsteve@gmail.com', '4567', 'male', 1, 0),
(14, 'Ken', 'Lamar', 'ken@lamar.com', '1234', 'male', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `wallet_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount_available` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wallet`
--

INSERT INTO `tbl_wallet` (`wallet_id`, `customer_id`, `amount_available`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 8, 51900, '2021-11-10 14:11:14', '2021-12-13 19:06:48', 0),
(3, 9, 3600, '2021-11-30 10:41:46', '2021-11-30 10:43:18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_type` (`payment_type`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`orderdetails_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_paymenttypes`
--
ALTER TABLE `tbl_paymenttypes`
  ADD PRIMARY KEY (`paymenttype_id`);

--
-- Indexes for table `tbl_productimages`
--
ALTER TABLE `tbl_productimages`
  ADD PRIMARY KEY (`productimages_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `tbl_userlogins`
--
ALTER TABLE `tbl_userlogins`
  ADD PRIMARY KEY (`userlogin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `orderdetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_paymenttypes`
--
ALTER TABLE `tbl_paymenttypes`
  MODIFY `paymenttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_productimages`
--
ALTER TABLE `tbl_productimages`
  MODIFY `productimages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_userlogins`
--
ALTER TABLE `tbl_userlogins`
  MODIFY `userlogin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_users` (`user_id`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`payment_type`) REFERENCES `tbl_paymenttypes` (`paymenttype_id`);

--
-- Constraints for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD CONSTRAINT `tbl_orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`);

--
-- Constraints for table `tbl_productimages`
--
ALTER TABLE `tbl_productimages`
  ADD CONSTRAINT `tbl_productimages_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `tbl_users` (`user_id`),
  ADD CONSTRAINT `tbl_productimages_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`);

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `tbl_subcategories` (`subcategory_id`),
  ADD CONSTRAINT `tbl_products_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  ADD CONSTRAINT `tbl_subcategories_ibfk_1` FOREIGN KEY (`category`) REFERENCES `tbl_categories` (`category_id`);

--
-- Constraints for table `tbl_userlogins`
--
ALTER TABLE `tbl_userlogins`
  ADD CONSTRAINT `tbl_userlogins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `tbl_roles` (`role_id`);

--
-- Constraints for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD CONSTRAINT `tbl_wallet_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
