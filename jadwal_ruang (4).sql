-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 08:23 AM
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
  `id_pinjam` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_ruang` int(255) DEFAULT NULL,
  `id_unit` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_pinjam`
--

INSERT INTO `jadwal_pinjam` (`id_pinjam`, `tanggal`, `jam_awal`, `jam_akhir`, `nama_peminjam`, `keterangan`, `id_ruang`, `id_unit`) VALUES
(5, '2005-12-12', '00:00:00', '12:00:00', '', '', 4, 5),
(7, '2005-12-12', '00:00:00', '12:00:00', '', '', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `m_ruang`
--

CREATE TABLE `m_ruang` (
  `id_ruang` int(255) NOT NULL,
  `nama_ruang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_ruang`
--

INSERT INTO `m_ruang` (`id_ruang`, `nama_ruang`) VALUES
(4, 'Ruang Makan'),
(5, 'Ruang Bermain');

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `id_unit` int(255) NOT NULL,
  `nama_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`id_unit`, `nama_unit`) VALUES
(5, 'Primary'),
(6, 'Secondary');

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
('admin', '$2y$10$GAXyJtEtqGajnBuRDD6Vt.oA.NxNzvUQeF5Lw9oNOiXH1vVboT2fm', 'admin');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_pinjam`
--
ALTER TABLE `jadwal_pinjam`
  MODIFY `id_pinjam` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_ruang`
--
ALTER TABLE `m_ruang`
  MODIFY `id_ruang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `id_unit` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
