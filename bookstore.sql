-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 01:48 AM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(25, '  Như Bây Giờ Vẫn Ổn', 'Như Bây Giờ Vẫn Ổn', '90000', 1, 10, '1888582166.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 1, 10),
(26, ' Wabi Sabi - Chấp Nhận Những Khiếm Khuyết, Sống Cuộc Đời An Nhiên', '\r\nWabi Sabi - Chấp Nhận Những Khiếm Khuyết, Sống Cuộc Đời An Nhiên', '100000', 1, 0, '1285768922.jpg', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 12, 10),
(27, ' Truyện Tối Trăng Mưa', '\r\nTruyện Tối Trăng Mưa', '200000', 1, 0, '1894466377.jpg', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 2, 10),
(28, ' Khoa Học Khám Phá - Stephen Hawking: Một Hồi Ức Về Tình Bạn & Vật Lý Học', 'Khoa Học Khám Phá - Stephen Hawking: Một Hồi Ức Về Tình Bạn & Vật Lý Học', '119000', 1, 10, '1437343880.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 3, 11),
(29, 'Dễ Thương', 'Dễ Thương', '90000', 1, 10, '2114590008.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 3, 12),
(30, '   Sinh Vật Huyền Bí Và Nơi Tìm Ra Chúng', ' \r\n\r\nSinh Vật Huyền Bí Và Nơi Tìm Ra Chúng', '58000', 1, 0, '490943374.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 12, 14),
(31, 'Quidditch Qua Các Thời Đại', 'Quidditch Qua Các Thời Đại', '89000', 1, 0, '1753491212.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 5, 13),
(32, ' Thầy Giáo Biến Hình 01 - Quái Vật Xuất Hiện Trong Lớp Học', 'Thầy Giáo Biến Hình 01 - Quái Vật Xuất Hiện Trong Lớp Học', '75000', 0, 0, '1063466092.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 1, 14),
(33, '   Xuyên Thành Phản Diện Biết Sống Sao Đây? ', ' \r\n\r\nXuyên Thành Phản Diện Biết Sống Sao Đây? - Tập 2 - Tặng Kèm Popup Standee', '189000', 1, 3, '1900838474.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 3, 15),
(34, '  Trái Tim Không', 'Trái Tim Không', '53000', 1, 0, '1440136388.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 2, 15),
(35, ' Somsokha Hạnh Phúc', 'Somsokha Hạnh Phúc', '89000', 1, 5, '1635583735.jpg', '2021-10-10', 'admin', '2021-10-10', 'admin', 1, 9, 14);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `names` text NOT NULL,
  `pictures` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`) VALUES
('1203838366', 'admin', '[\"24\"]', '[\"31680\"]', '[\"1\"]', '[\"Programming Logics\"]', '[\"sbx52yne.jpg\"]', 0, '2021-10-02 08:43:18'),
('812617976', 'admin', '[\"24\"]', '[\"31680\"]', '[\"1\"]', '[\"Programming Logics\"]', '[\"sbx52yne.jpg\"]', 0, '2021-09-26 12:09:48'),
('ePfD6au', 'admin', '[\"13\",\"19\"]', '[\"33950\",\"51300\"]', '[\"1\",\"1\"]', '[\"Functional Programming in Scala\",\"PostgreSQL Server Programming\"]', '[\"7kyub3oi.jpg\",\"x3et42jv.jpg\"]', 0, '2013-12-18 11:20:51'),
('GoFw4UN', 'admin', '[\"13\",\"24\",\"16\",\"23\"]', '[\"33950\",\"31680\",\"35280\",\"34400\"]', '[\"2\",\"3\",\"3\",\"1\"]', '[\"Functional Programming in Scala\",\"Programming Logics\",\"Advanced Programming in the UNIX Environment, 3rd Edition\",\"Advanced Network Programming - Principles and Techniques\"]', '[\"7kyub3oi.jpg\",\"sbx52yne.jpg\",\"2yo48fgm.jpg\",\"vradhky9.jpg\"]', 0, '2013-12-25 06:41:06'),
('iKYZHlr', 'admin', '[\"13\",\"24\",\"16\"]', '[\"33950\",\"31680\",\"35280\"]', '[\"1\",\"2\",\"2\"]', '[\"Functional Programming in Scala\",\"Programming Logics\",\"Advanced Programming in the UNIX Environment, 3rd Edition\"]', '[\"7kyub3oi.jpg\",\"sbx52yne.jpg\",\"2yo48fgm.jpg\"]', 0, '2013-12-18 06:04:48'),
('zdebsc3', 'admin', '[\"13\"]', '[\"33950\"]', '[\"1\"]', '[\"Functional Programming in Scala\"]', '[\"7kyub3oi.jpg\"]', 0, '2013-12-18 06:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(10, 'Tiểu thuyết', '1742596096.jpg', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 1),
(11, 'Sách kinh tế', '1018669680.jfif', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 1),
(12, 'Kỹ năng sống', '223759155.jfif', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 1),
(13, 'Ngoại ngữ', '82143014.jfif', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 1),
(14, 'Sáchthiếu nhi', '36346077.jfif', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 1),
(15, 'Chính trị', '797467678.jfif', '2021-10-10', 'admin', '0000-00-00', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `privilege_id` text NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`, `picture`) VALUES
(1, 'Admin', 1, '2013-11-11', 'admin', '2013-11-12', 'admin', 1, 5, '1,2,3,4,5,6,7,8,9,10', ''),
(2, 'Manager', 1, '2013-11-07', 'admin', '2013-12-03', 'admin', 1, 4, '1,2,3,4,6,7,8,9,10', ''),
(3, 'Member', 0, '2013-11-12', 'admin', '2013-12-03', 'admin', 0, 12, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'admin', 'user', 'index'),
(2, 'Thay đổi status của người dùng', 'admin', 'user', 'status'),
(3, 'Cập nhật thông tin của người dùng', 'admin', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'admin', 'user', 'ajaxStatus'),
(5, 'Xóa một hoặc nhiều người dùng', 'admin', 'user', 'trash'),
(6, 'Thay đổi vị trí hiển thị của các người dùng', 'admin', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'admin', 'index', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'admin', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'admin', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoản quản trị', 'admin', 'index', 'profile');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT '0000-00-00 00:00:00',
  `register_ip` varchar(25) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`) VALUES
(4, 'admin', 'buithanhtho14ig@gmail.com', 'Admin', '2103b1fee07d29de64b5f165885cffc0', '0000-00-00', '1', '0000-00-00', NULL, '0000-00-00 00:00:00', NULL, 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
