-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 04:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockupdate`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(5) NOT NULL,
  `branch_name` varchar(30) DEFAULT NULL,
  `branch_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_location`) VALUES
(1, 'ร้านปลาตาเทพ', 'ท่าไหม่ ');

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(10) NOT NULL,
  `supplier_id` int(8) NOT NULL,
  `buy_date` date DEFAULT NULL,
  `buy_status` int(10) DEFAULT NULL,
  `recv_date` date DEFAULT NULL,
  `due_pay_date` date DEFAULT NULL,
  `pay_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`buy_id`, `supplier_id`, `buy_date`, `buy_status`, `recv_date`, `due_pay_date`, `pay_date`) VALUES
(5, 1, '2020-03-04', 1, '2020-03-10', '2020-03-07', '2020-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `buy_desc`
--

CREATE TABLE `buy_desc` (
  `id` int(10) UNSIGNED NOT NULL,
  `buy_id` int(10) NOT NULL,
  `prod_id` int(8) NOT NULL,
  `order_amount` int(10) UNSIGNED DEFAULT NULL,
  `recv_amount` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_desc`
--

INSERT INTO `buy_desc` (`id`, `buy_id`, `prod_id`, `order_amount`, `recv_amount`) VALUES
(1, 5, 4, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `buy_status_desc`
--

CREATE TABLE `buy_status_desc` (
  `buy_status` int(10) NOT NULL,
  `buy_status_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_status_desc`
--

INSERT INTO `buy_status_desc` (`buy_status`, `buy_status_desc`) VALUES
(1, 'รออนุมัติ'),
(2, 'อนุมัติแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(8) NOT NULL,
  `supplier_id` int(8) NOT NULL,
  `prod_desc` varchar(100) DEFAULT NULL,
  `prod_cost` int(10) UNSIGNED DEFAULT NULL,
  `prod_price` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `supplier_id`, `prod_desc`, `prod_cost`, `prod_price`) VALUES
(1, 1, 'ปลาทอง', 10, 20),
(2, 1, 'ปลาหางนกยุง', 1, 3),
(3, 2, 'ลูกหมอ', 1, 2),
(4, 2, 'ลูกปลาดุก', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_request`
--

CREATE TABLE `product_request` (
  `req_id` int(10) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `req_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_request`
--

INSERT INTO `product_request` (`req_id`, `branch_id`, `req_date`) VALUES
(1, 1, '2020-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `prod_id` int(8) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `total` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_stock`
--

INSERT INTO `product_stock` (`prod_id`, `branch_id`, `total`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_desc`
--

CREATE TABLE `request_desc` (
  `req_id` int(5) NOT NULL,
  `prod_id` int(8) NOT NULL,
  `recv_amount` int(10) UNSIGNED DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `req_amount` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_desc`
--

INSERT INTO `request_desc` (`req_id`, `prod_id`, `recv_amount`, `cost`, `req_amount`) VALUES
(1, 4, 100, '50.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(8) NOT NULL,
  `supplier_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_desc`) VALUES
(1, 'นาย พงศธร '),
(2, 'นาย อภิชาย');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `buy_FKIndex1` (`supplier_id`),
  ADD KEY `buy_fk2` (`buy_status`);

--
-- Indexes for table `buy_desc`
--
ALTER TABLE `buy_desc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buy_desc_FKIndex1` (`prod_id`),
  ADD KEY `buy_desc_FKIndex2` (`buy_id`);

--
-- Indexes for table `buy_status_desc`
--
ALTER TABLE `buy_status_desc`
  ADD PRIMARY KEY (`buy_status`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `product_FKIndex1` (`supplier_id`);

--
-- Indexes for table `product_request`
--
ALTER TABLE `product_request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `product_request_FKIndex1` (`branch_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`prod_id`,`branch_id`),
  ADD KEY `product_stock_FKIndex1` (`prod_id`),
  ADD KEY `product_stock_FKIndex2` (`branch_id`);

--
-- Indexes for table `request_desc`
--
ALTER TABLE `request_desc`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `request_desc_FKIndex2` (`prod_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buy_desc`
--
ALTER TABLE `buy_desc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buy_status_desc`
--
ALTER TABLE `buy_status_desc`
  MODIFY `buy_status` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_request`
--
ALTER TABLE `product_request`
  MODIFY `req_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_fk1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `buy_fk2` FOREIGN KEY (`buy_status`) REFERENCES `buy_status_desc` (`buy_status`);

--
-- Constraints for table `buy_desc`
--
ALTER TABLE `buy_desc`
  ADD CONSTRAINT `buy_desc_fk1` FOREIGN KEY (`buy_id`) REFERENCES `buy` (`buy_id`),
  ADD CONSTRAINT `buy_desc_fk2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `product_request`
--
ALTER TABLE `product_request`
  ADD CONSTRAINT `product_re_fk1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD CONSTRAINT `p_stock_fk1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`),
  ADD CONSTRAINT `p_stock_fk2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `request_desc`
--
ALTER TABLE `request_desc`
  ADD CONSTRAINT `desc_fk1` FOREIGN KEY (`req_id`) REFERENCES `product_request` (`req_id`),
  ADD CONSTRAINT `desc_fk2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
