-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 05:50 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_hari`
--

CREATE TABLE `data_hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_hari`
--

INSERT INTO `data_hari` (`id_hari`, `nama_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat');

-- --------------------------------------------------------

--
-- Table structure for table `data_jadpel`
--

CREATE TABLE `data_jadpel` (
  `id_jadpel` int(11) NOT NULL,
  `jadpel_mapel` int(11) NOT NULL,
  `jadpel_kelas` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `waktu_mulai` varchar(10) NOT NULL,
  `waktu_selesai` varchar(10) NOT NULL,
  `pengajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_jadpel`
--

INSERT INTO `data_jadpel` (`id_jadpel`, `jadpel_mapel`, `jadpel_kelas`, `hari`, `waktu_mulai`, `waktu_selesai`, `pengajar`) VALUES
(7, 1, 4, 1, '07:00', '10:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `data_kejuruan`
--

CREATE TABLE `data_kejuruan` (
  `id_kejuruan` int(11) NOT NULL,
  `nama_kejuruan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kejuruan`
--

INSERT INTO `data_kejuruan` (`id_kejuruan`, `nama_kejuruan`) VALUES
(1, 'MULTIMEDIA'),
(2, 'TEKNIK KOMPUTER & JARINGAN'),
(3, 'TATA KELOLA PERKANTORAN');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id_kelas` int(11) NOT NULL,
  `kejuruan` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kelas`
--

INSERT INTO `data_kelas` (`id_kelas`, `kejuruan`, `nama_kelas`) VALUES
(1, 1, 'X'),
(2, 1, 'XI'),
(3, 1, 'XII'),
(4, 2, 'X'),
(5, 2, 'XI'),
(6, 2, 'XII'),
(7, 3, 'X'),
(8, 3, 'XI'),
(9, 3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `data_mapel`
--

CREATE TABLE `data_mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_mapel`
--

INSERT INTO `data_mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Komputer & Dasar Jaringan'),
(2, 'Pemrograman Dasar'),
(4, 'Matematika');

-- --------------------------------------------------------

--
-- Table structure for table `data_role`
--

CREATE TABLE `data_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_role`
--

INSERT INTO `data_role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Guru');

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `nisn` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `status_siswa` varchar(10) NOT NULL,
  `jk_siswa` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email_siswa` varchar(255) NOT NULL,
  `notelp_siswa` varchar(20) NOT NULL,
  `motto_siswa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `kelas`, `nisn`, `password`, `nama_siswa`, `status_siswa`, `jk_siswa`, `foto`, `email_siswa`, `notelp_siswa`, `motto_siswa`) VALUES
(1, 9, '1234567890', '$2y$10$T8SI4DXUfIyUHDGuhh1MAub0xy0mQdDarNXGkisW3zujI3p0Kv.VK', 'Cikamlia', 'aktif', 'Wanita', 'png-clipart-mysql-mysql.png', 'cikamlia@smkdiponegoro1.com', '08123432876', 'Ilmu hanya menjadi sia-sia saja bila tidak diamalkan kepada orang lain.'),
(3, 6, '0987654321', '$2y$10$YoKjYqu4Hy02Xc/NJ6pE2.eYQQQ9cjTyoa5PfiARKtGlzBAqix8dm', 'Rivan', 'aktif', 'Pria', 'siswa.jpg', 'ranvierrivankun@gmail.com', '081283143133', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_staff`
--

CREATE TABLE `data_staff` (
  `id_staff` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_staff` varchar(50) NOT NULL,
  `status_staff` varchar(10) NOT NULL,
  `jk_staff` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email_staff` varchar(255) NOT NULL,
  `notelp_staff` varchar(20) NOT NULL,
  `motto_staff` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_staff`
--

INSERT INTO `data_staff` (`id_staff`, `role`, `nik`, `password`, `nama_staff`, `status_staff`, `jk_staff`, `foto`, `email_staff`, `notelp_staff`, `motto_staff`) VALUES
(1, 1, '1', '$2y$10$/Dv/VWTJ5shycdvLO/2MtuSlrW6TKde8d1p.ohFjvJD5hQaI1xAYm', 'Admin E-Learning', 'aktif', 'Pria', 'logo-yayasan-al-hidayah-sma-diponegoro-jkt.jpg', 'admin.e-learning@smkdiponegoro1.com', '000000000', 'Siswa tidak membutuhkan guru yang sempurna. Siswa membutuhkan seorang guru yang bahagia. Siapa yang akan membuat mereka bersemangat untuk datang ke sekolah dan menumbuhkan kecintaan untuk belajar.'),
(2, 2, '2', '$2y$10$2HhiRLw3m6VTeIcOMxPkPOxuSHYjkm5.pN9fbfraTXLJf/TKb7/Gu', 'Imam Abdul', 'aktif', 'Pria', 'staff.jpg', 'imamabdul@smkdiponegoro1.com', '111222333', ''),
(3, 3, '3', '$2y$10$TAAhHodBKzUxlxqeXp9UvOkuIi8J4vLTQYM/YQBOcIfbyZCEVuQ.i', 'Aisha Nadine', 'aktif', 'Wanita', 'staff.jpg', 'aishanadine@smkdiponegoro1.com', '333222111', ''),
(6, 3, '3525015201880002', '$2y$10$ZcuOX5T3MFn/R3ZANRLpfuQq115zkAjB7CZMBlRzN31ILMadmG6.K', 'Test Guru', 'nonaktif', 'Pria', 'staff.jpg', 'testguru@smkdiponegoro1.com', '081285323412', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_sekolah`) VALUES
(1, 'SMK Diponegoro 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_hari`
--
ALTER TABLE `data_hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `data_jadpel`
--
ALTER TABLE `data_jadpel`
  ADD PRIMARY KEY (`id_jadpel`);

--
-- Indexes for table `data_kejuruan`
--
ALTER TABLE `data_kejuruan`
  ADD PRIMARY KEY (`id_kejuruan`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `data_mapel`
--
ALTER TABLE `data_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `data_role`
--
ALTER TABLE `data_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `data_staff`
--
ALTER TABLE `data_staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_hari`
--
ALTER TABLE `data_hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_jadpel`
--
ALTER TABLE `data_jadpel`
  MODIFY `id_jadpel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_kejuruan`
--
ALTER TABLE `data_kejuruan`
  MODIFY `id_kejuruan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_mapel`
--
ALTER TABLE `data_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_role`
--
ALTER TABLE `data_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_staff`
--
ALTER TABLE `data_staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
