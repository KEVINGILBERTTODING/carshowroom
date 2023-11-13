-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2023 at 12:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(300) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `photo_profile` varchar(255) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `is_active`, `photo_profile`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$LDMEAh8SH3aRNfxhndgfEOl/2atuirP/BibQOCegXOhRc2vIkACfS', 1, 'default.png', NULL, '2023-11-05 15:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `app_id` int NOT NULL,
  `app_name` varchar(50) DEFAULT NULL,
  `no_hp` char(18) DEFAULT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'main_logo.png',
  `email` varchar(80) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`app_id`, `app_name`, `no_hp`, `logo`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Rizqi Motor', '08232323', 'main_logo.png', 'rizqimotor@gmail.com', 'Jl. Menteri Supeno No.12, Semarang Selatan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_bakar`
--

CREATE TABLE `bahan_bakar` (
  `bahan_bakar_id` bigint NOT NULL,
  `bahan_bakar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bahan_bakar`
--

INSERT INTO `bahan_bakar` (`bahan_bakar_id`, `bahan_bakar`, `created_at`, `updated_at`) VALUES
(1, 'Bensin (geosoline)', '2023-11-04 12:26:12', '2023-11-04 12:30:29'),
(3, 'Solar', '2023-11-04 15:49:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `body`
--

CREATE TABLE `body` (
  `body_id` int NOT NULL,
  `body` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `body`
--

INSERT INTO `body` (`body_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 'SUV', '2023-11-04 14:59:42', NULL),
(2, 'Sedan', '2023-11-04 14:59:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `finance_id` bigint NOT NULL,
  `nama_finance` varchar(150) NOT NULL,
  `deskripsi` text,
  `url_website` text,
  `url_facebook` text,
  `url_instagram` text,
  `telepon` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 == active\r\n0 == tidak active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`finance_id`, `nama_finance`, `deskripsi`, `url_website`, `url_facebook`, `url_instagram`, `telepon`, `email`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Mandala Finance', 'Mandala finance adalah salah satu perusahaan terbaik', 'website', 'facebook', 'instagram', '082271313698', 'mandala@finance.com', 'Finance_1699158441.jpg', 1, '2023-11-05 04:19:24', '2023-11-05 14:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas_mesin`
--

CREATE TABLE `kapasitas_mesin` (
  `km_id` int NOT NULL,
  `kapasitas` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kapasitas_mesin`
--

INSERT INTO `kapasitas_mesin` (`km_id`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, '12.000 CC', '2023-11-04 16:07:23', '2023-11-04 16:07:31'),
(3, '1000 CC', '2023-11-07 21:07:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas_penumpang`
--

CREATE TABLE `kapasitas_penumpang` (
  `kp_id` int NOT NULL,
  `kapasitas` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kapasitas_penumpang`
--

INSERT INTO `kapasitas_penumpang` (`kp_id`, `kapasitas`, `created_at`, `updated_at`) VALUES
(5, '6-7 Orang', '2023-11-06 12:41:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `merk_id` int NOT NULL,
  `merk` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`merk_id`, `merk`, `created_at`, `updated_at`) VALUES
(1, 'Honda', '2023-11-04 10:09:28', NULL),
(4, 'Toyota', '2023-11-06 13:33:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `mobil_id` bigint NOT NULL,
  `merk_id` int NOT NULL,
  `body_id` int NOT NULL,
  `nama_model` varchar(255) NOT NULL,
  `no_plat` varchar(50) DEFAULT NULL,
  `no_mesin` varchar(50) NOT NULL,
  `no_rangka` varchar(50) NOT NULL,
  `tahun` char(7) DEFAULT NULL,
  `warna_id` int NOT NULL,
  `km_id` int NOT NULL,
  `bahan_bakar_id` int NOT NULL,
  `transmisi_id` int NOT NULL,
  `kp_id` int NOT NULL,
  `km` char(50) DEFAULT NULL,
  `tangki_id` int NOT NULL,
  `harga_beli` float NOT NULL,
  `biaya_perbaikan` float DEFAULT NULL,
  `harga_jual` float DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `diskon` float DEFAULT NULL,
  `nama_pemilik` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_mobil` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = available\r\n2 = booked\r\n0 = soldout',
  `status_post` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = public\r\n0 = private',
  `url_youtube` text,
  `deskripsi` text,
  `gambar1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gambar6` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`mobil_id`, `merk_id`, `body_id`, `nama_model`, `no_plat`, `no_mesin`, `no_rangka`, `tahun`, `warna_id`, `km_id`, `bahan_bakar_id`, `transmisi_id`, `kp_id`, `km`, `tangki_id`, `harga_beli`, `biaya_perbaikan`, `harga_jual`, `tgl_masuk`, `diskon`, `nama_pemilik`, `status_mobil`, `status_post`, `url_youtube`, `deskripsi`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `gambar5`, `gambar6`, `created_at`, `updated_at`) VALUES
(2, 4, 2, 'Fortuner H2', 'H 2323JJS', 'KL2932U3', 'KL903232', '2023', 7, 1, 1, 1, 5, '20000', 1, 120000000, 2000000, 450000000, '2023-11-07', 1000000, 'KEVIN', 0, 1, 'https://www.youtube.com/watch?v=HVmx-z8Bbwg', 'sdsdsd', 'gambar1_1699278716.png', 'gambar2_1699278716.png', 'gambar3_2023-11-09-12-21-18.jpg', 'gambar4_1699278716.png', 'gambar5_1699278716.png', '1698853342_2 (2).jpg', '2023-11-06 13:51:56', '2023-11-12 06:06:32'),
(3, 4, 2, 'Pajero Sport', 'H 2323JJS', 'KL2932U3', 'KL903232', '2023', 7, 1, 1, 1, 5, '20000', 1, 120000000, 2000000, 700000000, '2023-11-07', 1000000, 'KEVIN', 0, 1, 'https://www.youtube.com/watch?v=HVmx-z8Bbwg', 'sdsdsd', 'gambar1_1699278716.png', 'gambar2_1699278716.png', 'gambar3_2023-11-09-12-21-18.jpg', 'gambar4_1699278716.png', 'gambar5_1699278716.png', '1698853342_2 (2).jpg', '2023-11-06 13:51:56', '2023-11-11 11:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` bigint NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = succes\r\n2 = proses\r\n0 = tidak valid\r\n3 = finance proses\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = belum dibaca\r\n1 = telah dibaca',
  `user_id` bigint NOT NULL,
  `transaksi_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` bigint NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(300) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `photo_profile` varchar(255) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `name`, `email`, `password`, `is_active`, `photo_profile`, `created_at`, `updated_at`) VALUES
(5, 'Owner', 'owner@gmail.com', '$2y$10$bXxXtrFdCOYcWpNSLIHxpeaNdCO9Vz06jrYHaBs.V23oGyxL4bNBi', 1, 'default.png', '2023-11-11 07:33:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` varchar(150) NOT NULL,
  `nama_lengkap` varchar(80) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `nama_lengkap`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
('PLG-2023-11-10-22-08-59', 'Kotadadas', 'kampung', '08323232', '2023-11-10 15:08:59', '2023-11-11 11:59:51'),
('PLG-2023-11-11-18-28-47', 'Julita', 'pemanikan, no26', '0823272321', '2023-11-11 11:28:47', NULL),
('PLG-2023-11-11-18-33-02', 'Vanessia Dwi Putri', 'Jl. Pahlawan', '0808023', '2023-11-11 11:33:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_kredit`
--

CREATE TABLE `pengajuan_kredit` (
  `transaksi_id` varchar(150) NOT NULL,
  `finance_id` int NOT NULL,
  `ktp_suami` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ktp_istri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan_kredit`
--

INSERT INTO `pengajuan_kredit` (`transaksi_id`, `finance_id`, `ktp_suami`, `ktp_istri`, `kk`, `created_at`, `updated_at`) VALUES
('TRX-PLG-2023-11-11-18-33-02', 2, 'KTP-suami-PLG-2023-11-11-18-33-02.jpg', NULL, 'KK-PLG-2023-11-11-18-33-02.jpg', '2023-11-11 11:33:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tangki`
--

CREATE TABLE `tangki` (
  `tangki_id` int NOT NULL,
  `tangki` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tangki`
--

INSERT INTO `tangki` (`tangki_id`, `tangki`, `created_at`, `updated_at`) VALUES
(1, '2000 Liter', '2023-11-04 15:29:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` varchar(150) NOT NULL,
  `mobil_id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `pelanggan_id` varchar(150) DEFAULT NULL,
  `payment_method` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '1 = cash\r\n2 = credit\r\n3 = transfer',
  `total_pembayaran` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1 = valid\r\n2 = process\r\n3 = finance process\r\n0 = Tidak valid',
  `alasan` text,
  `bukti_pembayaran` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `mobil_id`, `user_id`, `pelanggan_id`, `payment_method`, `total_pembayaran`, `status`, `alasan`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
('TRX-PLG-2023-11-11-18-33-02', 2, NULL, 'PLG-2023-11-11-18-33-02', '2', 449000000, 1, NULL, NULL, '2023-11-11 11:33:02', '2023-11-12 06:06:32'),
('TRX-PLG-2023-11-11-18-33-022\r\n', 3, NULL, 'PLG-2023-11-11-18-33-02', '2', 300000000, 1, NULL, NULL, '2023-12-11 11:33:02', '2023-11-12 06:06:32'),
('TRX-PLG-2023-11-11-18-33-0223\r\n', 3, NULL, 'PLG-2023-11-11-18-33-02', '2', 300000000, 1, NULL, NULL, '2023-12-11 11:33:02', '2023-11-12 06:06:32'),
('TRX-PLG-2023-11-11-18-33-02233\r\n', 3, NULL, 'PLG-2023-11-11-18-33-02', '2', 300000000, 2, NULL, NULL, '2023-12-11 11:33:02', '2023-11-12 06:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `transmisi`
--

CREATE TABLE `transmisi` (
  `transmisi_id` int NOT NULL,
  `transmisi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transmisi`
--

INSERT INTO `transmisi` (`transmisi_id`, `transmisi`, `created_at`, `updated_at`) VALUES
(1, 'Manual 2', '2023-11-04 14:36:11', '2023-11-04 14:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(80) NOT NULL,
  `no_hp` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif\r\n0 = tidak aktif',
  `profile_photo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `nama_lengkap`, `no_hp`, `alamat`, `status`, `profile_photo`, `created_at`, `updated_at`) VALUES
(1, 'keren@gmail.com', 'dsdsdsd', 'keren', '082271313698', 'Jl. Pembangunan No.32 Toraja Utara', 1, 'default.png', '2023-11-10 11:44:31', '2023-11-11 12:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `warna_id` int NOT NULL,
  `warna` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`warna_id`, `warna`, `created_at`, `updated_at`) VALUES
(7, 'Hitam kuning', '2023-11-04 04:17:09', '2023-11-04 04:51:10'),
(9, 'Hijau', '2023-11-04 04:46:03', NULL),
(10, 'Putih', '2023-11-04 04:46:12', NULL),
(11, 'Kuning hijau', '2023-11-04 04:46:22', '2023-11-04 04:51:51'),
(12, 'Silver', '2023-11-04 04:46:31', NULL),
(13, 'Jingga', '2023-11-04 04:46:42', NULL),
(14, 'Merah', '2023-11-04 04:46:53', NULL),
(15, 'Cream', '2023-11-04 04:47:11', NULL),
(16, 'Biru', '2023-11-04 04:47:22', NULL),
(18, 'Pink', '2023-11-04 04:47:38', NULL),
(19, 'Hitam Glossy', '2023-11-04 04:47:47', NULL),
(20, 'Hitam Glossy Pekat', '2023-11-04 04:48:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `bahan_bakar`
--
ALTER TABLE `bahan_bakar`
  ADD PRIMARY KEY (`bahan_bakar_id`);

--
-- Indexes for table `body`
--
ALTER TABLE `body`
  ADD PRIMARY KEY (`body_id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`finance_id`);

--
-- Indexes for table `kapasitas_mesin`
--
ALTER TABLE `kapasitas_mesin`
  ADD PRIMARY KEY (`km_id`);

--
-- Indexes for table `kapasitas_penumpang`
--
ALTER TABLE `kapasitas_penumpang`
  ADD PRIMARY KEY (`kp_id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`mobil_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pengajuan_kredit`
--
ALTER TABLE `pengajuan_kredit`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tangki`
--
ALTER TABLE `tangki`
  ADD PRIMARY KEY (`tangki_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `transmisi`
--
ALTER TABLE `transmisi`
  ADD PRIMARY KEY (`transmisi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`warna_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `app_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bahan_bakar`
--
ALTER TABLE `bahan_bakar`
  MODIFY `bahan_bakar_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `body`
--
ALTER TABLE `body`
  MODIFY `body_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `finance_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kapasitas_mesin`
--
ALTER TABLE `kapasitas_mesin`
  MODIFY `km_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kapasitas_penumpang`
--
ALTER TABLE `kapasitas_penumpang`
  MODIFY `kp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `mobil_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tangki`
--
ALTER TABLE `tangki`
  MODIFY `tangki_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transmisi`
--
ALTER TABLE `transmisi`
  MODIFY `transmisi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `warna_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
