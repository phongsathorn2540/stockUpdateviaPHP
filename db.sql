-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 03:21 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(10) NOT NULL,
  `supplier_id` int(8) NOT NULL,
  `buy_date` date DEFAULT NULL,
  `buy_status` varchar(50) DEFAULT NULL,
  `recv_date` date DEFAULT NULL,
  `due_pay_date` date DEFAULT NULL,
  `pay_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `product_request`
--

CREATE TABLE `product_request` (
  `req_id` int(10) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `req_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `prod_id` int(8) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `total` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(8) NOT NULL,
  `supplier_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `buy_FKIndex1` (`supplier_id`);

--
-- Indexes for table `buy_desc`
--
ALTER TABLE `buy_desc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buy_desc_FKIndex1` (`prod_id`),
  ADD KEY `buy_desc_FKIndex2` (`buy_id`);

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
  ADD KEY `product_request_has_product_stock_FKIndex1` (`req_id`),
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
  MODIFY `branch_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_desc`
--
ALTER TABLE `buy_desc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_request`
--
ALTER TABLE `product_request`
  MODIFY `req_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(8) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
