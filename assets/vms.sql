-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 11:29 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nopeg` varchar(128) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nopeg`, `name`, `phone`) VALUES
(1, '9707850', 'Luthfy Qyordano Aryady', '085155095549');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Luthfy Qyordano A', 'luthfyqyordano@garudapratama.com', 'user.png', '$2y$10$PmBs0Qu.KiyvMirYhAo9sevFDPBmfIrWdDDmEMRfaqH9gG1r3Gh7K', 1, 1, 1618194157),
(4, 'Ibnu', 'ibnu@garudapratama.com', 'user1.png', '$2y$10$vlOEz7yxX81UY32FLpjHEOddkRMxHuWJLApSZ6zM/O/uPWayeLZK6', 2, 1, 1618201669),
(5, 'danang', 'danang@garudapratama.com', 'default.jpg', '$2y$10$hDOqcdFarAjYcS.ZQnOcK.L1qGe5qHY7uOlCaBl8ycZw5QO7F/3Ou', 2, 1, 1618203547),
(9, 'Kapindiang', 'kapindiangs87@gmail.com', 'default.jpg', '$2y$10$wBPXhtZ73ZwQrzlLNXR4HOLTFSaeqlC5ZDl2LFQspm2L3kqHq.hTq', 2, 1, 1618799139),
(10, 'kapindiang77', 'kapindiang77@gmail.com', 'default.jpg', '$2y$10$Dhez0DLAQ0EeeWsVI4WiBuqZDD25l.dtC/tpS.t.4jxw5J1zJEAQ2', 2, 1, 1618799535),
(12, 'ict', 'ict.gdps@gmail.com', 'default.jpg', '$2y$10$OQ8gPnrYp9LvpaCgMHQFCePrJUtCu6tn12fthABKasdbt0ktkaYIO', 2, 1, 1621571534);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 1, 3),
(6, 2, 2),
(11, 1, 12),
(12, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(4, 'Finance'),
(5, 'Human Resource');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(10, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(11, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(12, 12, 'Employee', 'hris', 'far fa-fw fa-user', 1),
(19, 13, 'New Billing', 'billing', 'fab fa-fw fa-youtube', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(6, 'kapindiang77@gmail.com', '0IhQx8IsU8wu2agKSVjU4vA5XRgPSz9fPY6dJNkezQs=', 1618800750),
(12, 'ict.gdps@gmail.com', 'HE4hjVerZ5pT0+xUlYPlSqxdEt6fPawlBJCdj3q2Jr4=', 1621581693);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id_visit` int(11) NOT NULL,
  `kd_visit` varchar(255) NOT NULL,
  `nopeg` varchar(20) NOT NULL,
  `last_update` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id_visit`, `kd_visit`, `nopeg`, `last_update`) VALUES
(1, 'VS160621001', '9707850', '16-06-2021 12:41:50'),
(2, 'VS160621002', '9707850', '16-06-2021 13:19:37'),
(3, 'VS160621003', '9707850', '16-06-2021 13:20:30'),
(4, 'VS160621004', '123456', '16-06-2021 13:21:47'),
(5, 'VS160621005', '12345', '16-06-2021 13:22:55'),
(6, 'VS160621006', '12345', '16-06-2021 13:23:59'),
(7, 'VS160621007', '9707850', '16-06-2021 13:25:57'),
(8, 'VS160621008', '9707850', '16-06-2021 13:27:47'),
(9, 'VS160621009', '9707850', '16-06-2021 13:28:03'),
(10, 'VS1606210010', '9707850', '16-06-2021 13:29:26'),
(11, 'VS1606210011', '9707850', '16-06-2021 13:32:25'),
(12, 'VS1606210012', '9707850', '16-06-2021 13:33:23'),
(13, 'VS1606210013', '9707850', '16-06-2021 13:36:29'),
(14, 'VS1606210014', '123', '16-06-2021 16:19:12'),
(15, 'VS1606210015', '123', '16-06-2021 16:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `visit_detail`
--

CREATE TABLE `visit_detail` (
  `id_visit_detail` int(11) NOT NULL,
  `kd_visit` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `ktp` varchar(128) NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `purposes` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `idcard` varchar(255) NOT NULL,
  `check_in` varchar(128) NOT NULL,
  `check_out` varchar(128) NOT NULL,
  `last_update` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visit_detail`
--

INSERT INTO `visit_detail` (`id_visit_detail`, `kd_visit`, `name`, `ktp`, `address`, `phone`, `purposes`, `selfie`, `idcard`, `check_in`, `check_out`, `last_update`) VALUES
(1, 'VS160621001', 'Oki', '123456789', 'Bogor', '081234567890', 'testing', '19.jpg', '4.png', '16-06-2021 12:41:50', '-', '16-06-2021 12:41:50'),
(2, 'VS160621004', 'testing', '123456', 'testing', '1234567890', 'testing', '6067dba1ade59.jpg', 'Capture2.PNG', '16-06-2021 13:21:47', '-', '16-06-2021 13:21:47'),
(3, 'VS1606210014', 'Ryo', '123', 'tangerang', '081234567890', 'testing', 'absen_berhasil.jpg', 'Capture.PNG', '16-06-2021 16:19:12', '-', '16-06-2021 16:19:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id_visit`);

--
-- Indexes for table `visit_detail`
--
ALTER TABLE `visit_detail`
  ADD PRIMARY KEY (`id_visit_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `id_visit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visit_detail`
--
ALTER TABLE `visit_detail`
  MODIFY `id_visit_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
