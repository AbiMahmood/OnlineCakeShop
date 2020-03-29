-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2018 at 03:11 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(32, 'Vanilla Cakes'),
(33, 'Strawberry Cakes');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `validation_code` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`id`, `first_name`, `last_name`, `username`, `address`, `zipcode`, `phone`, `email`, `password`, `validation_code`, `active`) VALUES
(48, 'abi', 'mahmood', 'abimahmood', 'khilgaon', '1219', '01988810008', 'abimahmood.bd@gmail.com', '202cb962ac59075b964b07152d234b70', '2542a236b1c1fc62b9ddafff2387b6b7', 1),
(49, 'vujuk pakhi', 'ddsadf', 'asdf', 'asdfsadfadf', '1212', '01788810008', 'minhaz7232@gmail.com', '202cb962ac59075b964b07152d234b70', 'bd77fd2610befe072fced99d359da782', 0),
(50, 'Abdullah', 'Mahmood', 'Abimahmood2', '218/B KHILGAON CHOWDHURYPARA', '1219', '1788810008', 'rakibul.hasan11@northsouth.edu', '202cb962ac59075b964b07152d234b70', 'ef87f1fa0c34990a4fbfaa503b7158c7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_amount` float NOT NULL,
  `order_transaction` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `short_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `short_desc`, `product_image`) VALUES
(110, 'Strawberry Madness', 33, 50, 5, 'Cake 5 Product Description', 'Cake 5 Product Short Description', 'cake5.jpg'),
(114, 'Vanilla Choco', 32, 1000, 5, 'cake2 Product Description', 'cake2 Product Short Description', 'cake1.jpg'),
(115, 'White Vanilla ', 32, 200, 2, 'Vanilla 2 Product Description', 'Vanilla2 Product Short Description', 'cake2.jpg'),
(116, 'Pink Vanilla', 32, 300, 2, 'Cake3 Product Description', 'Cake3 Product Short Description', 'cake3.jpg'),
(117, 'Blue Vanilla', 32, 400, 5, 'Blue vanilla is very delicious. it has sky tone', 'sky color, tasy', 'cake4.jpg'),
(118, 'Vanilla Smash', 32, 600, 10, 'Vanilla Smash is a very good cake', 'smash, good, cake', 'Cake6.gif'),
(119, 'Choco Hazelnut', 31, 1000, 2, 'Hazelnut with Choco, very yummy', 'Flourless ,, choco, hazelnut', 'cake7.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `product_id`, `order_id`, `product_price`, `product_title`, `product_quantity`) VALUES
(37, 1, 61, 24.99, 'product 1', 1),
(38, 1, 62, 24.99, 'product 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_title` varchar(255) NOT NULL,
  `slide_id` int(11) NOT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_title`, `slide_id`, `slide_image`) VALUES
('new cake', 20, 'image_6.jpg'),
('img1', 21, 'image_1.jpg'),
('img2', 22, 'image_2.jpg'),
('img3', 23, 'image_3.jpg'),
('img4', 24, 'image_4.jpg'),
('Cake2', 25, 'image_1.jpg'),
('ads', 26, 'image_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(5, 'rico', 'edwin@edwindiaz.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
