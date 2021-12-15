-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 04:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `checkout_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `username`, `name`, `address`, `phone`, `checkout_id`) VALUES
(1, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b4e77ecdb6c'),
(2, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b4fb5b50b5b'),
(3, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b566d625f2b'),
(4, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b5671edf723'),
(5, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b5674728086'),
(6, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b567d22bc4d'),
(7, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b581905f569'),
(8, 'abu@sakib', 'Abu M Sakib', '07-Kabkaba, Dhaka-6900, Dhaka', '01334567890', '61b583795f304'),
(9, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b7273f0a8ef'),
(10, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01534567890', '61b79ddceaa00'),
(11, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b79f051e2d2'),
(12, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b7a493c08e4'),
(13, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-7777, Dhaka', '01334567890', '61b7a64cc074e'),
(14, 'ryu@ryu', 'Ryusha', 'Banglo-47, Dhaka-6900, Dhaka', '01334567890', '61b90543430eb');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `bookdetails`
--

CREATE TABLE `bookdetails` (
  `id` int(11) NOT NULL,
  `bookname` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` varchar(5) NOT NULL,
  `category` varchar(20) NOT NULL,
  `isbn` varchar(50) DEFAULT '',
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookdetails`
--

INSERT INTO `bookdetails` (`id`, `bookname`, `author`, `price`, `category`, `isbn`, `description`, `image`) VALUES
(3, 'MyBook 02', 'SM Pavel', '99', 'Fantasy', '20-43400-1', 'a dummy description for book2', '../resourses/books/1639043714-book2.jfif'),
(4, 'MyBook 03', 'SM Pavel', '299', 'Fantasy', '[20434001]', 'a dummy description for book3', '../resourses/books/1639043741-book3.jpg'),
(5, 'MyBook 04', 'SM Pavel', '399', 'Fantasy', '[20-43400-1]', 'a dummy description for book4', '../resourses/books/1639043765-book4.jfif'),
(7, 'MyBook 05', 'SM Pavel', '299', 'Fantasy', '[ 20-43400-1 ]', 'a dummy description for book5', '../resourses/books/1639084023-book5.jfif'),
(9, 'MyBook 06', 'SM Pavel', '999', 'Action', '[20 43400 1]', 'a dummy book', '../resourses/books/1639250415-book8.png'),
(10, 'MyBook 01', 'SM Pavel', '199', 'Thriller', '20434001', 'a dummy desc for book1', '../resourses/books/1639254464-book1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `book_id` varchar(100) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `book_id`, `book_name`, `img`, `price`, `total_price`, `quantity`, `user_id`) VALUES
(37, '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', '999', '1', 'pavel1@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`) VALUES
(1, 'Action'),
(2, 'Fantasy'),
(12, 'Harem'),
(14, 'Manga'),
(4, 'Nature'),
(7, 'Romance'),
(3, 'Science'),
(15, 'SS');

-- --------------------------------------------------------

--
-- Table structure for table `orderaddress`
--

CREATE TABLE `orderaddress` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `order_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderaddress`
--

INSERT INTO `orderaddress` (`id`, `address_id`, `order_id`) VALUES
(1, 1, '1639245701ryu@ryu'),
(4, 2, '1639250802ryu@ryu'),
(5, 3, '1639278309ryu@ryu'),
(8, 4, '1639278369ryu@ryu'),
(9, 5, '1639278409ryu@ryu'),
(12, 6, '1639278547ryu@ryu'),
(13, 7, '1639285140ryu@ryu'),
(15, 8, '1639285640abu@sakib'),
(16, 9, '1639393096ryu@ryu'),
(18, 10, '1639423460ryu@ryu'),
(19, 11, '1639423751ryu@ryu'),
(21, 12, '1639425174ryu@ryu'),
(22, 13, '1639425616ryu@ryu'),
(23, 14, '1639515460ryu@ryu');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sno` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `book_id` varchar(200) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `img` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `date_of_purchase` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `paid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sno`, `order_id`, `book_id`, `book_name`, `img`, `price`, `quantity`, `total_price`, `user_id`, `date_of_purchase`, `status`, `payment_method`, `paid`) VALUES
(1, '1639245701ryu@ryu', '7', 'MyBook 05', '../resourses/books/1639084023-book5.jfif', '299', 2, '598', 'ryu@ryu', '2021-12-11 07:01:41', 'order placed', 'COD', 'no'),
(2, '1639245701ryu@ryu', '5', 'MyBook 04', '../resourses/books/1639043765-book4.jfif', '399', 1, '399', 'ryu@ryu', '2021-12-11 07:01:41', 'order placed', 'COD', 'no'),
(3, '1639245701ryu@ryu', '6', 'MyBook 01', '../resourses/books/1639052448-book1.jpeg', '199', 5, '995', 'ryu@ryu', '2021-12-11 07:01:41', 'order placed', 'COD', 'no'),
(4, '1639250802ryu@ryu', '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', 3, '2997', 'ryu@ryu', '2021-12-11 08:26:42', 'order placed', 'COD', 'no'),
(5, '1639278309ryu@ryu', '4', 'MyBook 03', '../resourses/books/1639043741-book3.jpg', '299', 1, '299', 'ryu@ryu', '2021-12-12 04:05:09', 'order placed', 'COD', 'no'),
(6, '1639278309ryu@ryu', '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', 1, '999', 'ryu@ryu', '2021-12-12 04:05:09', 'order placed', 'COD', 'no'),
(7, '1639278309ryu@ryu', '3', 'MyBook 02', '../resourses/books/1639043714-book2.jfif', '99', 4, '396', 'ryu@ryu', '2021-12-12 04:05:09', 'order placed', 'COD', 'no'),
(8, '1639278369ryu@ryu', '7', 'MyBook 05', '../resourses/books/1639084023-book5.jfif', '299', 1, '299', 'ryu@ryu', '2021-12-12 04:06:09', 'order placed', 'COD', 'no'),
(9, '1639278409ryu@ryu', '3', 'MyBook 02', '../resourses/books/1639043714-book2.jfif', '99', 1, '99', 'ryu@ryu', '2021-12-12 04:06:49', 'order placed', 'COD', 'no'),
(10, '1639278409ryu@ryu', '10', 'MyBook 01', '../resourses/books/1639254464-book1.jpeg', '199', 1, '199', 'ryu@ryu', '2021-12-12 04:06:49', 'order placed', 'COD', 'no'),
(11, '1639278409ryu@ryu', '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', 1, '999', 'ryu@ryu', '2021-12-12 04:06:49', 'order placed', 'COD', 'no'),
(12, '1639278547ryu@ryu', '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', 1, '999', 'ryu@ryu', '2021-12-12 04:09:07', 'order placed', 'COD', 'no'),
(13, '1639285140ryu@ryu', '10', 'MyBook 01', '../resourses/books/1639254464-book1.jpeg', '199', 3, '597', 'ryu@ryu', '2021-12-12 05:59:00', 'order placed', 'COD', 'no'),
(14, '1639285140ryu@ryu', '4', 'MyBook 03', '../resourses/books/1639043741-book3.jpg', '299', 1, '299', 'ryu@ryu', '2021-12-12 05:59:00', 'order placed', 'COD', 'no'),
(15, '1639285640abu@sakib', '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', 1, '999', 'abu@sakib', '2021-12-12 06:07:20', 'order placed', 'COD', 'no'),
(16, '1639393096ryu@ryu', '9', 'MyBook 06', '../resourses/books/1639250415-book8.png', '999', 1, '999', 'ryu@ryu', '2021-12-13 11:58:16', 'order placed', 'COD', 'no'),
(17, '1639393096ryu@ryu', '7', 'MyBook 05', '../resourses/books/1639084023-book5.jfif', '299', 1, '299', 'ryu@ryu', '2021-12-13 11:58:16', 'order placed', 'COD', 'no'),
(18, '1639423460ryu@ryu', '3', 'MyBook 02', '../resourses/books/1639043714-book2.jfif', '99', 1, '99', 'ryu@ryu', '2021-12-13 08:24:20', 'order placed', 'COD', 'no'),
(19, '1639423751ryu@ryu', '3', 'MyBook 02', '../resourses/books/1639043714-book2.jfif', '99', 1, '99', 'ryu@ryu', '2021-12-13 08:29:11', 'order placed', 'COD', 'no'),
(20, '1639423751ryu@ryu', '10', 'MyBook 01', '../resourses/books/1639254464-book1.jpeg', '199', 1, '199', 'ryu@ryu', '2021-12-13 08:29:11', 'order placed', 'COD', 'no'),
(21, '1639425174ryu@ryu', '3', 'MyBook 02', '../resourses/books/1639043714-book2.jfif', '99', 1, '99', 'ryu@ryu', '2021-12-13 08:52:54', 'order placed', 'COD', 'no'),
(22, '1639425616ryu@ryu', '3', 'MyBook 02', '../resourses/books/1639043714-book2.jfif', '99', 1, '99', 'ryu@ryu', '2021-12-14 02:00:16', 'order placed', 'COD', 'no'),
(23, '1639515460ryu@ryu', '5', 'MyBook 04', '../resourses/books/1639043765-book4.jfif', '399', 1, '399', 'ryu@ryu', '2021-12-15 02:57:40', 'order placed', 'COD', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `registeredusers`
--

CREATE TABLE `registeredusers` (
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registeredusers`
--

INSERT INTO `registeredusers` (`user_id`, `name`, `username`, `mobile`, `password`, `image`) VALUES
(1, 'Pavel', 'pavel@mail.com', '018xxxxxxxxx', '12345', ''),
(2, 'Noushan', 'noushan@mail.com', '017xxxxxxxxx', '12345', ''),
(3, 'Al-Nahin', 'alnahin@mail.com', '013xxxxxxxxx', '12345', ''),
(4, 'Ryusha', 'ryu@ryu', '01234567890', '00bba9724a24d638c08c793e230cc372', '../resourses/users/1639085695-chinese-dragon-illustration_113398-177.jpg'),
(5, 'Abu Sakib', 'abu@sakib', '00000000000', 'a5aee91d7c426e9ba223b05577749708', '../resourses/users/1639285426-125186947_1432183493839410_6848344652756916801_n.jpg'),
(7, 'Pavel', 'pavel1@mail.com', '01700000008', '3127a272fc498f916bb2b905014097cf', '../resourses/users/1639424193-kang_tae-sik.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookdetails`
--
ALTER TABLE `bookdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookname` (`bookname`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories` (`categories`);

--
-- Indexes for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `registeredusers`
--
ALTER TABLE `registeredusers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookdetails`
--
ALTER TABLE `bookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orderaddress`
--
ALTER TABLE `orderaddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `registeredusers`
--
ALTER TABLE `registeredusers`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
