-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2014 at 11:25 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `allo_rapido_pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
`cartId` int(11) NOT NULL,
  `cartDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sessionId` varchar(255) NOT NULL,
  `customerId` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cartId`, `cartDate`, `sessionId`, `customerId`) VALUES
(28, '2014-11-01 22:24:44', 'hagg7jkmp7l7fmh5ec4k6jmgu0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts_products`
--

CREATE TABLE IF NOT EXISTS `carts_products` (
`n` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `cartProductQuantity` int(11) NOT NULL DEFAULT '1',
  `cartId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Pizzas'),
(2, 'Desserts'),
(4, 'Boissons');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`customerId` int(11) NOT NULL,
  `customerEmail` varchar(255) NOT NULL,
  `customerPassword` varchar(255) NOT NULL,
  `customerCivility` varchar(255) NOT NULL,
  `customerLastName` varchar(255) NOT NULL,
  `customerFirstName` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerZipCode` varchar(255) NOT NULL,
  `customerCity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`orderId` int(11) NOT NULL,
  `orderDate`timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
`n` int(11) NOT NULL,
  `orderProductName` varchar(255) NOT NULL,
  `orderProductPrice` float(5,2) NOT NULL,
  `orderProductQuantity` int(11) NOT NULL DEFAULT '1',
  `productId` int(11) DEFAULT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` text NOT NULL,
  `productPrice` float(5,2) NOT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `productDescription`, `productPrice`, `categoryId`) VALUES
(1, 'Marguerita', 'Tomate, fromage, olives, origan.', 6.90, 1),
(2, 'Napolitaine', 'Tomate, fromage, anchois, câpres, olives, origan.', 6.90, 1),
(7, 'Mama Reine', 'Tomate, fromage, jambon, champignons, origan.', 6.90, 1),
(8, 'Calzone', 'Tomate, fromage, jambon ou viande hachée ou thon, oeuf.', 6.90, 1),
(9, 'Tarte citron', '', 2.50, 2),
(10, 'Tarte au daim', '', 2.50, 2),
(11, 'Tarte aux pommes', '', 2.50, 2),
(12, 'Brownie', '', 2.50, 2),
(13, 'Muffin', '', 2.50, 2),
(14, 'Tiramisu', '', 2.50, 2),
(15, 'Eau minérale 33cl', '', 1.00, 4),
(16, 'Coca Cola 33cl', '', 1.30, 4),
(17, 'Coca Cola light 33cl', '', 1.30, 4),
(18, 'Orangina 33cl', '', 1.30, 4),
(19, 'Fanta 33cl', '', 1.30, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
 ADD PRIMARY KEY (`cartId`), ADD KEY `userId` (`customerId`);

--
-- Indexes for table `carts_products`
--
ALTER TABLE `carts_products`
 ADD PRIMARY KEY (`n`), ADD KEY `productId` (`productId`), ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`customerId`), ADD UNIQUE KEY `customerEmail` (`customerEmail`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`orderId`), ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
 ADD PRIMARY KEY (`n`), ADD KEY `productId` (`productId`), ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`productId`), ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `carts_products`
--
ALTER TABLE `carts_products`
MODIFY `n` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
MODIFY `n` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts_products`
--
ALTER TABLE `carts_products`
ADD CONSTRAINT `carts_products_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `carts_products_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
