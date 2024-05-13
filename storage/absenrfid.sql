-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2024 at 03:02 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenrfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_mode`
--

CREATE TABLE `api_mode` (
  `mode` text NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_ruang`
--

CREATE TABLE `kategori_ruang` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_ruang_has`
--

CREATE TABLE `kategori_ruang_has` (
  `id` int NOT NULL,
  `kategori_ruang_id` int NOT NULL,
  `tb_ruang_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int NOT NULL,
  `id_murid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_mapel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kelas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_ruang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jam_masuk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jam_keluar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_api`
--

CREATE TABLE `tb_api` (
  `id_api` int NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `api_mode_id` int NOT NULL DEFAULT '0',
  `counter` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar`
--

CREATE TABLE `tb_daftar` (
  `id` int NOT NULL,
  `id_api` int NOT NULL,
  `id_murid` int NOT NULL,
  `terdaftar` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nama` text NOT NULL,
  `id_mapel` text NOT NULL,
  `id_guru` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jampel`
--

CREATE TABLE `tb_jampel` (
  `id_jampel` int NOT NULL,
  `hari` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `1` text NOT NULL,
  `2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `8` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `9` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `10` text NOT NULL,
  `11` text NOT NULL,
  `12` text NOT NULL,
  `13` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jampel`
--

INSERT INTO `tb_jampel` (`id_jampel`, `hari`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`) VALUES
(1, 'senin', '{\"start\":\"07:00\",\"end\":\"07:45\"}', '{\"start\":\"07:00\",\"end\":\"08:30\"}', '{\"start\":\"08:30\",\"end\":\"09:15\"}', '{\"start\":\"09:15\",\"end\":\"10:00\"}', '{\"start\":\"10:15\",\"end\":\"10:55\"}', '{\"start\":\"10:55\",\"end\":\"11:35\"}', '{\"start\":\"12:30\",\"end\":\"13:00\"}', '{\"start\":\"13:00\",\"end\":\"13:30\"}', '{\"start\":\"13:30\",\"end\":\"14:00\"}', '{\"start\":\"14:00\",\"end\":\"14:30\"}', '{\"start\":\"14:30\",\"end\":\"15:00\"}', '{\"start\":\"15:00\",\"end\":\"15:30\"}', '{\"start\":\"15:30\",\"end\":\"16:00\"}'),
(2, 'selasa', '{\"start\":\"07:00\",\"end\":\"07:45\"}', '{\"start\":\"07:45\",\"end\":\"08:30\"}', '{\"start\":\"08:30\",\"end\":\"09:15\"}', '{\"start\":\"09:15\",\"end\":\"10:00\"}', '{\"start\":\"10:15\",\"end\":\"10:55\"}', '{\"start\":\"10:55\",\"end\":\"11:35\"}', '{\"start\":\"12:30\",\"end\":\"13:00\"}', '{\"start\":\"13:00\",\"end\":\"13:30\"}', '{\"start\":\"13:30\",\"end\":\"14:00\"}', '{\"start\":\"14:00\",\"end\":\"14:30\"}', '{\"start\":\"14:30\",\"end\":\"15:00\"}', '{\"start\":\"15:00\",\"end\":\"15:30\"}', '{\"start\":\"15:30\",\"end\":\"16:00\"}'),
(3, 'rabu', '{\"start\":\"07:00\",\"end\":\"07:45\"}', '{\"start\":\"07:45\",\"end\":\"08:30\"}', '{\"start\":\"08:30\",\"end\":\"09:15\"}', '{\"start\":\"09:15\",\"end\":\"10:00\"}', '{\"start\":\"10:15\",\"end\":\"10:55\"}', '{\"start\":\"10:55\",\"end\":\"11:35\"}', '{\"start\":\"12:30\",\"end\":\"13:00\"}', '{\"start\":\"13:00\",\"end\":\"13:30\"}', '{\"start\":\"13:30\",\"end\":\"14:00\"}', '{\"start\":\"14:00\",\"end\":\"14:30\"}', '{\"start\":\"14:30\",\"end\":\"15:00\"}', '{\"start\":\"15:00\",\"end\":\"15:30\"}', '{\"start\":\"15:30\",\"end\":\"16:00\"}'),
(4, 'kamis', '{\"start\":\"07:00\",\"end\":\"07:45\"}', '{\"start\":\"07:45\",\"end\":\"08:30\"}', '{\"start\":\"08:30\",\"end\":\"09:15\"}', '{\"start\":\"09:15\",\"end\":\"10:00\"}', '{\"start\":\"10:15\",\"end\":\"10:55\"}', '{\"start\":\"10:55\",\"end\":\"11:35\"}', '{\"start\":\"12:30\",\"end\":\"13:00\"}', '{\"start\":\"13:00\",\"end\":\"13:30\"}', '{\"start\":\"13:30\",\"end\":\"14:00\"}', '{\"start\":\"14:00\",\"end\":\"14:30\"}', '{\"start\":\"14:30\",\"end\":\"15:00\"}', '{\"start\":\"15:00\",\"end\":\"15:30\"}', '{\"start\":\"15:30\",\"end\":\"16:00\"}'),
(5, 'jumat', '{\"start\":\"07:00\",\"end\":\"07:40\"}', '{\"start\":\"07:40\",\"end\":\"08:20\"}', '{\"start\":\"08:20\",\"end\":\"09:00\"}', '{\"start\":\"09:00\",\"end\":\"09:40\"}', '{\"start\":\"10:00\",\"end\":\"10:40\"}', '{\"start\":\"10:40\",\"end\":\"11:20\"}', '{\"start\":\"13:00\",\"end\":\"13:30\"}', '{\"start\":\"13:30\",\"end\":\"14:00\"}', '{\"start\":\"14:00\",\"end\":\"14:30\"}', '{\"start\":\"14:30\",\"end\":\"15:00\"}', '{\"start\":\"15:00\",\"end\":\"15:30\"}', '{\"start\":\"15:30\",\"end\":\"16:00\"}', '{\"start\":\"00:00\",\"end\":\"00:00\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kelas` text NOT NULL,
  `id_guru` text NOT NULL,
  `id_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `mapel` text NOT NULL,
  `id_mapel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`mapel`, `id_mapel`) VALUES
('MTK', 1),
('Administrasi Sistem Jaringan', 2),
('PPKN', 3),
('PKK', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_murid`
--

CREATE TABLE `tb_murid` (
  `id_murid` int NOT NULL,
  `id_kartu` text NOT NULL,
  `id_kelas` text NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `id_ruang` int NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `senin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `selasa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rabu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kamis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_mapel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kelas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_mode`
--
ALTER TABLE `api_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_ruang`
--
ALTER TABLE `kategori_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_ruang_has`
--
ALTER TABLE `kategori_ruang_has`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `tb_api`
--
ALTER TABLE `tb_api`
  ADD PRIMARY KEY (`id_api`);

--
-- Indexes for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_jampel`
--
ALTER TABLE `tb_jampel`
  ADD PRIMARY KEY (`id_jampel`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_murid`
--
ALTER TABLE `tb_murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_mode`
--
ALTER TABLE `api_mode`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_ruang`
--
ALTER TABLE `kategori_ruang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_ruang_has`
--
ALTER TABLE `kategori_ruang_has`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_api`
--
ALTER TABLE `tb_api`
  MODIFY `id_api` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jampel`
--
ALTER TABLE `tb_jampel`
  MODIFY `id_jampel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_murid`
--
ALTER TABLE `tb_murid`
  MODIFY `id_murid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ruang`
--
ALTER TABLE `tb_ruang`
  MODIFY `id_ruang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
