-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql313.infinityfree.com
-- Generation Time: Jun 02, 2025 at 01:14 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_38472428_wns_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` varchar(10) NOT NULL,
  `gambar_menu` varchar(266) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `gambar_menu`, `menu`, `harga`, `stock`) VALUES
('1', 'img/mie.jpg', 'Watermelon Noodle', 25000, 127),
('2', 'img/jus.jpg', 'Smoothie Watermelon', 15000, 273);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(10) NOT NULL,
  `namaplg` varchar(100) NOT NULL,
  `notelpplg` varchar(20) NOT NULL,
  `quantity_1` int(100) NOT NULL,
  `quantity_2` int(100) NOT NULL,
  `total_price` int(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `selesai_date` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `namaplg`, `notelpplg`, `quantity_1`, `quantity_2`, `total_price`, `order_date`, `selesai_date`, `email`, `Status`) VALUES
('A977', 'Anggie Chunata', '082398420527', 1, 2, 55000, '2025-03-18 21:28:12', '0000-00-00 00:00:00', 'anggiechunata@gmail.com', 'Selesai'),
('A710', 'Mettakusuma', '083186932963', 2, 2, 80000, '2025-03-21 01:23:15', '0000-00-00 00:00:00', '', 'Selesai'),
('A881', 'Jeffri', '085298170942', 1, 1, 40000, '2025-03-22 09:19:23', '0000-00-00 00:00:00', '', 'Selesai'),
('A095', 'Anderson', '085287295834', 5, 7, 230000, '2025-03-22 09:23:24', '0000-00-00 00:00:00', '', 'Selesai'),
('A382', 'Andi Saputra', '082318152295', 3, 3, 120000, '2025-03-23 00:46:52', '0000-00-00 00:00:00', '', 'Selesai'),
('A372', 'Muhammad julaiman ', '081378410686', 0, 1, 15000, '2025-03-25 00:56:07', '0000-00-00 00:00:00', '', 'Selesai'),
('A516', 'Suryanto', '087402759481', 2, 4, 110000, '2025-03-28 07:38:19', '0000-00-00 00:00:00', '', 'Selesai'),
('A900', 'Chika', '082195832045', 5, 5, 200000, '2025-03-28 07:46:38', '0000-00-00 00:00:00', '', 'Selesai'),
('A837', 'Senny', '085258390183', 3, 5, 150000, '2025-03-28 08:27:35', '0000-00-00 00:00:00', '', 'Selesai'),
('A765', 'Freddy', '082158325840', 6, 5, 225000, '2025-04-03 00:16:32', '0000-00-00 00:00:00', 'Freddy39@gmail.com', 'Selesai'),
('A846', 'Angela Jocelyn', '082137945082', 3, 4, 135000, '2025-04-04 07:24:15', '0000-00-00 00:00:00', 'angelajocelyn@gmail.com', 'Selesai'),
('A835', 'Handi Chandra', '08529352093', 4, 6, 190000, '2025-04-03 01:25:00', '0000-00-00 00:00:00', 'handychandra93@gmail.com', 'Selesai'),
('A604', 'Mettawijaya', '085272634050', 4, 4, 160000, '2025-04-03 01:30:33', '0000-00-00 00:00:00', 'mettawijayawu@gmail.com', 'Selesai'),
('A705', 'albert', '088271092432', 5, 3, 170000, '2025-04-08 04:12:07', '0000-00-00 00:00:00', 'albertsmm25@gmail.com', 'Selesai'),
('A685', 'Billy Chandra', '085246732943', 3, 2, 105000, '2025-04-08 04:21:38', '0000-00-00 00:00:00', 'Billychandra@gmail.com', 'Selesai'),
('A109', 'Jeffri', '085174183992', 1, 1, 40000, '2025-04-08 05:42:50', '0000-00-00 00:00:00', 'Saigengaming@gmail.com', 'Selesai'),
('A038', 'Sherly Metta Puena', '085395732853', 5, 3, 170000, '2025-04-08 06:30:01', '0000-00-00 00:00:00', 'sherlymp01@gmail.com', 'Selesai'),
('A116', 'Charles', '081248329583', 3, 2, 105000, '2025-04-08 06:32:40', '0000-00-00 00:00:00', 'charleswu@gmail.com', 'Selesai'),
('A056', 'Fernando Owen', '084325649345', 2, 1, 65000, '2025-04-08 07:21:12', '0000-00-00 00:00:00', 'fernando_owen@gmail.com', 'Selesai'),
('A666', 'Mettakusuma', '083186932963', 2, 1, 65000, '2025-04-10 08:27:11', '0000-00-00 00:00:00', 'Mettakusumawu@gmail.com', 'Selesai'),
('A094', 'Wily Candra ', '085256881584', 1, 1, 40000, '2025-04-08 20:07:24', '0000-00-00 00:00:00', 'wilycandra05@gmail.com', 'Selesai'),
('A814', 'Sddsfd', '345554', 1, 1, 40000, '2025-04-10 03:44:47', '0000-00-00 00:00:00', 'Sdfddf@gmail.com', 'Selesai'),
('A761', 'Sherlin', '0895634932788', 1, 0, 25000, '2025-04-20 06:17:33', '0000-00-00 00:00:00', '-', 'Selesai'),
('A345', 'Metta', '22234', 2, 1, 65000, '2025-04-14 07:59:41', '0000-00-00 00:00:00', 'mettawijayawu@gmail.com', 'Selesai'),
('A064', 'Mettawijaya', '085272634050', 2, 1, 65000, '2025-04-15 08:49:53', '0000-00-00 00:00:00', 'Mettawijayawu@gmail.com', 'Selesai'),
('A617', 'Agus', '082287140022', 0, 1, 15000, '2025-04-20 06:17:53', '0000-00-00 00:00:00', '-', 'Selesai'),
('A471', 'Joswandi', '081269886798', 0, 1, 15000, '2025-04-20 06:24:38', '0000-00-00 00:00:00', '-', 'Selesai'),
('A973', 'Hansen', '082385546088', 1, 1, 40000, '2025-04-20 06:25:10', '0000-00-00 00:00:00', '-', 'Selesai'),
('A527', 'Ervina', '085731045780', 1, 0, 25000, '2025-04-20 04:42:41', '0000-00-00 00:00:00', '-', 'Selesai'),
('A388', 'Julius', '082171917786', 1, 0, 25000, '2025-04-20 04:43:18', '0000-00-00 00:00:00', '-', 'Selesai'),
('A278', 'Eric', '082268846849', 1, 0, 25000, '2025-04-20 04:43:56', '0000-00-00 00:00:00', '-', 'Selesai'),
('A967', 'Micheal', '081267669168', 2, 0, 50000, '2025-04-20 04:44:22', '0000-00-00 00:00:00', '-', 'Selesai'),
('A487', 'Steven Lim', '087747642633', 1, 1, 40000, '2025-04-20 04:47:40', '0000-00-00 00:00:00', '-', 'Selesai'),
('A754', ' ', '000', 1, 0, 25000, '2025-04-27 09:33:16', '0000-00-00 00:00:00', ' ', 'Pending'),
('A824', 'Mettawijaya', '085272634050', 4, 2, 110000, '2025-05-06 23:42:04', '0000-00-00 00:00:00', 'mettawijayawu@gmail.com', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `id` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `timecreate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`id`, `username`, `password`, `email`, `notelp`, `sex`, `status`, `timecreate`) VALUES
('000', 'Admin', 'admin', '-', '-', 'Male', 'Admin', '2025-03-08 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
