-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2020 at 01:14 AM
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
('satram@gmail.com', 16, 499.99, 3, 79.99, 2, 550, 0, 299),
('sonjak@gmail.com', 1, 499.99, 2, 79.99, 5, 550, 4, 299),
('the@the.com', 1, 499.99, 0, 79.99, 0, 550, 0, 299);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email_ID` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `email_ID`, `password`) VALUES
('Sathya', 'Ram', 'satram@gmail.com', '12345678'),
('sanjay', 'ram', 'sonjak@gmail.com', 'test_pass'),
('test', 'test', 'test', '12345678'),
('hi', 'bye', 'the@the.com', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`email_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
