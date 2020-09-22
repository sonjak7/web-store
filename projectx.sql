-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 11:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectx`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `email_ID` varchar(32) NOT NULL,
  `product1` int(32) NOT NULL,
  `prod1_price` double NOT NULL,
  `product2` int(32) NOT NULL,
  `prod2_price` double NOT NULL,
  `product3` int(32) NOT NULL,
  `prod3_price` double NOT NULL,
  `product4` int(32) NOT NULL,
  `prod4_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`email_ID`, `product1`, `prod1_price`, `product2`, `prod2_price`, `product3`, `prod3_price`, `product4`, `prod4_price`) VALUES
('sonjak@gmail.com', 2, 499.99, 0, 79.99, 0, 550, 0, 0),
('test@test.com', 0, 499.99, 0, 79.99, 0, 550, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(100) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `email_ID` varchar(32) NOT NULL,
  `feedback` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `firstname`, `email_ID`, `feedback`) VALUES
(33, 'sanjay', 'sonjak@gmail.com', 'good'),
(35, 'test', 'test@test.com', 'bad');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email_ID` varchar(32) NOT NULL,
  `password` varchar(360) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `email_ID`, `password`) VALUES
('sanjay', 'ram', 'sonjak@gmail.com', '67325a653234fc9f72d5138fd040b322f7d2dc38afe16ad7b9205625920027e8'),
('test', 'person', 'test@test.com', '82470495a07350a07ff3e2d40bc4de6957c13b7132d852b6f4610c7842479cf6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`email_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
