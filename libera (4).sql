-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2026 at 04:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libera`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `kelas`, `status`) VALUES
(4, 'edi', 'xii pplg 2', 'aktif'),
(5, 'majid', 'xii pplg 1', 'aktif'),
(7, 'majiddd', 'xii pplg 2', 'aktif'),
(8, 'nuryani', 'xii pplg 1', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `stok` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `tahun_terbit`, `stok`, `cover`, `penerbit`) VALUES
(5, 'bahasa ingris', 'edi', '2026', '20', '1770768836_.jpg', 'hj wawan'),
(7, 'pbo (pemrograman beriontasi objek)', 'asep sunandar', '2026', '200', '1770781137_pbo__pemrograman_beriontasi_objek_.jpg', 'budi sunanar'),
(8, 'bahasa indonesia', 'bapak anwar', '0000', '0', '1771818111_bahasa_indonesia.jfif', 'bapak anwar'),
(9, 'pwpb', 'majid', '0000', '79', '1771992327_pwpb.jfif', 'bapak anwar'),
(10, 'bahasa sunda', 'agus susanto', '2026', '180', '1775093346_bahasa_sunda.webp', 'hj ucu');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id_notif`, `id_transaksi`, `message`, `created_at`) VALUES
(13, 24, 'User pi meminjam buku \'bahasa ingris\' sebanyak 221111111 buku.', '2026-02-25 03:52:01'),
(14, 25, 'User lutvi meminjam buku \'\' sebanyak 12 buku.', '2026-04-01 05:06:57'),
(15, 32, 'edi wel meminjam buku pwpb sebanyak 27 buku.', '2026-04-01 06:30:26'),
(16, 33, ' meminjam buku bahasa indonesia sebanyak 20 buku.', '2026-04-02 00:31:00'),
(17, 34, ' meminjam buku bahasa sunda sebanyak 20 buku.', '2026-04-02 01:29:46'),
(18, 35, ' meminjam buku pwpb sebanyak 21 buku.', '2026-04-02 02:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `total_pinjam`
--

CREATE TABLE `total_pinjam` (
  `id_total_pinjam` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `total_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_pinjam`
--

INSERT INTO `total_pinjam` (`id_total_pinjam`, `id_transaksi`, `total_pinjam`) VALUES
(1, 15, 21),
(2, 17, 21);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('menunggu konfirmasi','disetujui','ditolak') NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `total_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_anggota`, `id_users`, `nama`, `judul_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `id_buku`, `total_pinjam`) VALUES
(15, NULL, 1, 'lutvi', 'pbo (pemrograman beriontasi objek)', '2026-02-12', '2026-02-12', '', 7, 21),
(17, NULL, 1, 'lutvi', 'bahasa indonesia', '2026-02-11', '2026-02-10', '', 8, 21),
(18, NULL, 1, 'lutvi', 'bahasa indonesia', '2026-02-01', '2026-02-01', '', 8, 200),
(19, NULL, 1, 'lutvi', 'bahasa indonesia', '2026-02-12', '2026-02-11', '', 8, 21),
(20, NULL, 1, 'majid', 'bahasa indonesia', '2026-02-25', '2026-02-25', 'menunggu konfirmasi', 8, 21),
(23, NULL, 1, 'pi', 'bahasa indonesia', '2026-02-03', '2026-02-03', '', NULL, 2112),
(28, NULL, 2, '', '', '2026-04-01', '2026-04-01', '', 9, 12),
(29, NULL, 2, '', '', '2026-04-08', '2026-04-08', '', 9, 21),
(30, NULL, 1, '', '', '2026-04-02', '2026-04-02', '', 9, 40),
(31, NULL, 1, '', '', '2026-04-02', '2026-04-01', '', 9, 27),
(32, NULL, 1, '', '', '2026-04-01', '2026-04-01', '', 9, 27),
(33, NULL, 4, '', '', '2026-04-02', '2026-04-02', '', 8, 20),
(34, NULL, 4, '', '', '2026-04-03', '2026-04-02', '', 10, 20),
(35, NULL, 4, '', '', '2026-04-02', '2026-04-02', '', 9, 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','siswa') NOT NULL,
  `status` enum('aktif','non_aktif') NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `username`, `password`, `level`, `status`, `last_login`, `created_at`) VALUES
(1, 'edi wel', 'lutvi', 'wel', 'siswa', 'aktif', NULL, '2026-04-02 00:52:58'),
(2, 'edi kurniawan', 'pi', 'we', 'admin', 'aktif', NULL, '2026-04-02 00:52:58'),
(4, '', 'majid', '123', 'siswa', 'aktif', NULL, '2026-04-02 00:52:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `total_pinjam`
--
ALTER TABLE `total_pinjam`
  ADD PRIMARY KEY (`id_total_pinjam`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `fk_transaksi_users` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `total_pinjam`
--
ALTER TABLE `total_pinjam`
  MODIFY `id_total_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `total_pinjam`
--
ALTER TABLE `total_pinjam`
  ADD CONSTRAINT `total_pinjam_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
