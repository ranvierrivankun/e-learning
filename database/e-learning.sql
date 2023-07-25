-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 08:43 AM
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
(7, 1, 6, 1, '07:00', '10:00', 3);

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
-- Table structure for table `data_materi`
--

CREATE TABLE `data_materi` (
  `id_materi` int(11) NOT NULL,
  `id_jadpel_materi` int(11) NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `des_materi` text NOT NULL,
  `file_materi` varchar(255) NOT NULL,
  `tgl_materi` varchar(50) NOT NULL,
  `tgl_update_materi` varchar(50) DEFAULT NULL,
  `user_materi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_materi`
--

INSERT INTO `data_materi` (`id_materi`, `id_jadpel_materi`, `judul_materi`, `des_materi`, `file_materi`, `tgl_materi`, `tgl_update_materi`, `user_materi`) VALUES
(9, 7, 'Pertemuan 1', 'Pelajari materi berikut untuk persiapan ulangan harian minggu depan', '31451649c06d069485b7e8fd3498d3f8.pdf', '', '2023-07-24 10:03', 3);

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
(1, 6, '1234567890', '$2y$10$T8SI4DXUfIyUHDGuhh1MAub0xy0mQdDarNXGkisW3zujI3p0Kv.VK', 'Cikamlia', 'aktif', 'Wanita', 'png-clipart-mysql-mysql.png', 'cikamlia@smkdiponegoro1.com', '08123432876', 'Ilmu hanya menjadi sia-sia saja bila tidak diamalkan kepada orang lain.'),
(3, 6, '0987654321', '$2y$10$YoKjYqu4Hy02Xc/NJ6pE2.eYQQQ9cjTyoa5PfiARKtGlzBAqix8dm', 'Rivan', 'aktif', 'Pria', 'siswa.jpg', 'ranvierrivankun@gmail.com', '081283143133', 'Orang yang malas belajar tidak akan bisa berkembang!');

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
(1, 1, '1', '$2y$10$/Dv/VWTJ5shycdvLO/2MtuSlrW6TKde8d1p.ohFjvJD5hQaI1xAYm', 'Admin E-Learning', 'aktif', 'Pria', 'logo-yayasan-al-hidayah-sma-diponegoro-jkt.jpg', 'admin.e-learning@smkdiponegoro1.com', '000000000000', 'Siswa tidak membutuhkan guru yang sempurna. Siswa membutuhkan seorang guru yang bahagia. Siapa yang akan membuat mereka bersemangat untuk datang ke sekolah dan menumbuhkan kecintaan untuk belajar.'),
(2, 2, '2', '$2y$10$2HhiRLw3m6VTeIcOMxPkPOxuSHYjkm5.pN9fbfraTXLJf/TKb7/Gu', 'Imam Abdul', 'aktif', 'Pria', 'staff.jpg', 'imamabdul@smkdiponegoro1.com', '081278659877', ''),
(3, 3, '3', '$2y$10$TAAhHodBKzUxlxqeXp9UvOkuIi8J4vLTQYM/YQBOcIfbyZCEVuQ.i', 'Aisha Nadine', 'aktif', 'Wanita', 'staff.jpg', 'aishanadine@smkdiponegoro1.com', '081287644322', ''),
(6, 3, '4', '$2y$10$ZcuOX5T3MFn/R3ZANRLpfuQq115zkAjB7CZMBlRzN31ILMadmG6.K', 'Hamza Haikal', 'aktif', 'Pria', 'staff.jpg', 'hamzahaikal@smkdiponegoro1.com', '081285323412', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_tugas`
--

CREATE TABLE `data_tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_jadpel_tugas` int(11) NOT NULL,
  `judul_tugas` varchar(255) NOT NULL,
  `des_tugas` text NOT NULL,
  `file_tugas` varchar(255) NOT NULL,
  `tgl_tugas` varchar(50) NOT NULL,
  `tgl_mulai_tugas` varchar(50) NOT NULL,
  `tgl_selesai_tugas` varchar(50) NOT NULL,
  `tgl_update_tugas` varchar(50) NOT NULL,
  `user_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_tugas`
--

INSERT INTO `data_tugas` (`id_tugas`, `id_jadpel_tugas`, `judul_tugas`, `des_tugas`, `file_tugas`, `tgl_tugas`, `tgl_mulai_tugas`, `tgl_selesai_tugas`, `tgl_update_tugas`, `user_tugas`) VALUES
(6, 7, 'Pertemuan 1', 'Kerjakan tugas berikut dengan baik dan benar', 'c28319cabbaf37e1b573c87fae6bc8df.pdf', '2023-07-25 08:32', '2023-07-25 12:00', '2023-07-26 12:00', '2023-07-25 08:32', 3);

-- --------------------------------------------------------

--
-- Table structure for table `data_tugas_selesai`
--

CREATE TABLE `data_tugas_selesai` (
  `id_tugas_selesai` int(11) NOT NULL,
  `tugas` int(11) NOT NULL,
  `user_tugas_selesai` int(11) NOT NULL,
  `file_tugas_selesai` text NOT NULL,
  `tgl_tugas_selesai` varchar(50) NOT NULL,
  `status_tugas_selesai` varchar(10) NOT NULL,
  `nilai_tugas` int(11) NOT NULL,
  `catatan_tugas` text DEFAULT NULL,
  `pengajar_tugas_selesai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_tugas_selesai`
--

INSERT INTO `data_tugas_selesai` (`id_tugas_selesai`, `tugas`, `user_tugas_selesai`, `file_tugas_selesai`, `tgl_tugas_selesai`, `status_tugas_selesai`, `nilai_tugas`, `catatan_tugas`, `pengajar_tugas_selesai`) VALUES
(15, 6, 1, 'https://sweetalert2.github.io/', '2023-07-25 08:32', 'proses', 0, NULL, NULL);

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
  ADD PRIMARY KEY (`id_jadpel`),
  ADD KEY `jadpel_mapel` (`jadpel_mapel`),
  ADD KEY `jadpel_kelas` (`jadpel_kelas`),
  ADD KEY `pengajar` (`pengajar`),
  ADD KEY `hari` (`hari`);

--
-- Indexes for table `data_kejuruan`
--
ALTER TABLE `data_kejuruan`
  ADD PRIMARY KEY (`id_kejuruan`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kejuruan` (`kejuruan`);

--
-- Indexes for table `data_mapel`
--
ALTER TABLE `data_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `data_materi`
--
ALTER TABLE `data_materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `id_jadpel_materi` (`id_jadpel_materi`);

--
-- Indexes for table `data_role`
--
ALTER TABLE `data_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `data_staff`
--
ALTER TABLE `data_staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `data_tugas`
--
ALTER TABLE `data_tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_jadpel_tugas` (`id_jadpel_tugas`);

--
-- Indexes for table `data_tugas_selesai`
--
ALTER TABLE `data_tugas_selesai`
  ADD PRIMARY KEY (`id_tugas_selesai`),
  ADD KEY `tugas` (`tugas`),
  ADD KEY `user_tugas_selesai` (`user_tugas_selesai`),
  ADD KEY `pengajar_tugas_selesai` (`pengajar_tugas_selesai`);

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
-- AUTO_INCREMENT for table `data_materi`
--
ALTER TABLE `data_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `data_tugas`
--
ALTER TABLE `data_tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_tugas_selesai`
--
ALTER TABLE `data_tugas_selesai`
  MODIFY `id_tugas_selesai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
