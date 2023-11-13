-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 02:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal_ruang`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pinjam`
--

CREATE TABLE `jadwal_pinjam` (
  `id_pinjam` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_ruang` varchar(255) NOT NULL,
  `id_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_pinjam`
--

INSERT INTO `jadwal_pinjam` (`id_pinjam`, `tanggal`, `jam_awal`, `jam_akhir`, `nama_peminjam`, `keterangan`, `id_ruang`, `id_unit`) VALUES
('K9eXI', '2023-11-09', '09:32:00', '00:32:00', 'Adam', 'update', '0001', '0011');

-- --------------------------------------------------------

--
-- Table structure for table `m_ruang`
--

CREATE TABLE `m_ruang` (
  `id_ruang` varchar(255) NOT NULL,
  `nama_ruang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_ruang`
--

INSERT INTO `m_ruang` (`id_ruang`, `nama_ruang`) VALUES
('0001', 'Ruang Makan'),
('0002', 'Ruang Keluarga'),
('0003', 'Ruang Bermain'),
('0004', 'Ruang Tidur');

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `id_unit` varchar(255) NOT NULL,
  `nama_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`id_unit`, `nama_unit`) VALUES
('0011', 'Primary'),
('0012', 'Secondarys'),
('0013', 'Tertiary');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`username`, `pass`, `nama_user`) VALUES
('adambahyn', '$2y$10$w98bM8C4JjUzYc.LCP/oCu.ygBaFuy2whHFUoDlpKil2QnPZnaPXi', 'adam');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(1) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `token`) VALUES
(1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_pinjam`
--
ALTER TABLE `jadwal_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `jdwl-ruang` (`id_ruang`),
  ADD KEY `jdwl-unit` (`id_unit`);

--
-- Indexes for table `m_ruang`
--
ALTER TABLE `m_ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `m_unit`
--
ALTER TABLE `m_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_pinjam`
--
ALTER TABLE `jadwal_pinjam`
  ADD CONSTRAINT `jdwl-ruang` FOREIGN KEY (`id_ruang`) REFERENCES `m_ruang` (`id_ruang`),
  ADD CONSTRAINT `jdwl-unit` FOREIGN KEY (`id_unit`) REFERENCES `m_unit` (`id_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
