-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2023 at 03:37 AM
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
  `token_password` char(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `is_active`, `photo_profile`, `token_password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'gilberttodingkevin@gmail.com', '$2y$10$UrnEb21M5mcSS89S0dmrheOBHOK7cf8KsuHGOd58nkZn554V27z3G', 1, 'default.png', NULL, NULL, '2023-12-02 04:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `app_id` int NOT NULL,
  `app_name` varchar(50) DEFAULT NULL,
  `no_hp` char(18) DEFAULT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'main_logo.png',
  `meta_token` text,
  `email` varchar(80) DEFAULT NULL,
  `alamat` text,
  `url_facebook` text,
  `url_instagram` text,
  `url_youtube` text,
  `jadwal` text,
  `visi` text,
  `misi` text,
  `img_hero` varchar(150) DEFAULT NULL,
  `img_about_us` varchar(150) DEFAULT NULL,
  `img_about_us2` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`app_id`, `app_name`, `no_hp`, `logo`, `meta_token`, `email`, `alamat`, `url_facebook`, `url_instagram`, `url_youtube`, `jadwal`, `visi`, `misi`, `img_hero`, `img_about_us`, `img_about_us2`, `created_at`, `updated_at`) VALUES
(1, 'Rizki Motor', '08126362324', 'AboutUs2-2023-12-02-05-24-24.png', '2421f8c64a776afe530038cbe68087c1', 'rizkimotor17@gmail.com', 'Jl. Hos Cokroaminoto Gg. 3 No.33, Mlati Norowito, Kec. Kota Kudus, Kabupaten Kudus, Jawa Tengah 59319', 'https://www.facebook.com/jualbelimobkas/', 'https://www.instagram.com/rizkimotorkudus/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA==', 'https://www.youtube.com/@rizkimotorkudus9227', 'Senin-jumat: 08:00 pagi - 18:00', 'Visi kami adalah menjadi pusat utama mobil bekas yang unggul, menawarkan lingkungan belanja inovatif dan ramah pelanggan. Kami bertekad untuk menjadi destinasi pilihan dengan inventaris terlengkap, kualitas terjamin, dan layanan pelanggan terbaik. Dengan profesionalisme, integritas, dan inovasi, kami ingin membentuk masa depan industri ini, memberikan kontribusi positif pada kepuasan pelanggan, dan mempercepat pertumbuhan bisnis.', 'Misi kami di Showroom Mobil Bekas adalah memprioritaskan kepuasan pelanggan melalui pengalaman belanja yang mudah. Kami komitmen menyediakan mobil berkualitas tanpa kompromi melalui seleksi ketat dan memanfaatkan inovasi teknologi. Dalam membangun komunitas pecinta otomotif, kami ingin menjadi destinasi utama untuk pembelian mobil bekas, memberikan kontribusi positif pada kepuasan pelanggan, dan terus berinovasi dalam pertumbuhan bisnis.', 'hero.png', 'unsplash_JoH-9BX08xA-min.png', 'AboutUs2-2023-11-29-23-53-42.png', NULL, '2023-12-01 22:24:24');

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
(3, 'Solar', '2023-11-04 15:49:33', NULL),
(4, 'Listrik', '2023-12-01 00:52:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `bank_id` int NOT NULL,
  `no_rekening` char(30) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`bank_id`, `no_rekening`, `nama`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, '32323', 'Rizki  Motor', 'BRI', NULL, NULL),
(2, '999033', 'Rizki  Motor', 'BCA', NULL, NULL);

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
(2, 'Sedan', '2023-11-04 14:59:49', NULL),
(3, 'Hatchback', '2023-11-16 05:11:52', NULL),
(4, 'Coupe', '2023-11-16 05:12:10', NULL),
(5, 'Wagon', '2023-11-16 05:12:42', NULL),
(6, 'Van', '2023-11-16 05:12:51', NULL),
(7, 'Jeep', '2023-11-16 05:13:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `finance_id` bigint NOT NULL,
  `nama_finance` varchar(150) NOT NULL,
  `bunga` char(5) NOT NULL,
  `biaya_asuransi` float NOT NULL,
  `biaya_administrasi` float NOT NULL,
  `uang_muka` float NOT NULL,
  `biaya_provisi` float NOT NULL,
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

INSERT INTO `finance` (`finance_id`, `nama_finance`, `bunga`, `biaya_asuransi`, `biaya_administrasi`, `uang_muka`, `biaya_provisi`, `deskripsi`, `url_website`, `url_facebook`, `url_instagram`, `telepon`, `email`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Adira Finance', '0.3', 2, 0.5, 20, 3, 'perusahaan yang berbasis di Indonesia, dan terdaftar di Bursa Efek Indonesia dengan kode emiten IDX: ADMF. Perusahaan ini lebih dikenal sebagai Adira Finance, dengan usaha utamanya bergerak dalam bidang penyediaan pembiayaan konsumen.', 'https://www.adira.co.id/', 'https://www.facebook.com/adirafinanceid/', 'https://www.instagram.com/adirafinanceid/?hl=en', '0823293232', 'adira@gmail.com', 'Finance_2023-11-16-05-56-05.jpg', 1, '2023-11-15 22:56:05', NULL),
(5, 'Mandala Finance', '5', 3, 2, 20, 3, 'PT Mandala Multifinance Tbk yang didirikan pada 21 Juli 1997 adalah sebuah perusahaan pembiayaan komersial yang berfokus pada bisnis pembiayaan sepeda motor, elektronik, furnitur, dan pembiayaan multiguna lainnya. Sebagai perusahaan yang berpengalaman lebih dari 25 tahun di industri jasa keuangan, Mandala memiliki komitmen untuk mengembangkan bisnisnya di Indonesia bersama seluruh lapisan masyarakat. Mandala hadir di 274 cabang yang tersebar di Sumatera, Kalimantan, Jawa, Nusa Tenggara, Sulawesi, Maluku, hingga Papua.', 'https://mandalafinance.com/id/home/', 'https://www.facebook.com/MandalaMultifinanceID/?ref=br_rs', 'https://www.instagram.com/mandala_fin/', '08232323', 'mandala@gmail.com', 'Finance_2023-11-16-06-08-21.jpg', 1, '2023-11-15 23:08:21', NULL);

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
(3, '1000 CC', '2023-11-07 21:07:57', NULL),
(4, '2500 CC', '2023-11-16 05:23:51', '2023-11-16 05:23:58');

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
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` bigint NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(80) NOT NULL,
  `no_hp` char(18) NOT NULL,
  `alamat` text,
  `password` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = is active\r\n0 = not active',
  `photo_profile` varchar(255) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `name`, `email`, `no_hp`, `alamat`, `password`, `status`, `photo_profile`, `created_at`, `updated_at`) VALUES
(2, 'Pegawai', 'gilberttodingkevin@gmail.com', '0808023', 'asdd', '$2y$10$rqFkyRgg2lVFWZJTRDadh.o3QXMpxhszOnU2zMgIbTBr9N04qCzdG', 1, 'default.png', '2023-11-14 07:02:50', '2023-12-01 01:42:35');

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
(4, 'Toyota', '2023-11-06 13:33:16', NULL),
(5, 'Mitsubishi', '2023-11-16 05:24:22', NULL);

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
  `url_instagram` text,
  `url_facebook` text,
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

INSERT INTO `mobil` (`mobil_id`, `merk_id`, `body_id`, `nama_model`, `no_plat`, `no_mesin`, `no_rangka`, `tahun`, `warna_id`, `km_id`, `bahan_bakar_id`, `transmisi_id`, `kp_id`, `km`, `tangki_id`, `harga_beli`, `biaya_perbaikan`, `harga_jual`, `tgl_masuk`, `diskon`, `nama_pemilik`, `status_mobil`, `status_post`, `url_youtube`, `url_instagram`, `url_facebook`, `deskripsi`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `gambar5`, `gambar6`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'Calya', 'H33431', 'J82933S', 'K23023', '2020', 19, 3, 1, 1, 5, '199996', 1, 120000000, 30000000, 200000000, '2023-11-16', 3000000, 'HUNS', 1, 1, 'https://www.youtube.com/watch?v=eJcRjDSF66E', 'https://www.instagram.com/p/CzP51k2SsFE/?utm_source=ig_web_copy_link&igshid=MzRlODBiNWFlZA==', 'https://www.instagram.com/p/CzP51k2SsFE/?utm_source=ig_web_copy_link&igshid=MzRlODBiNWFlZA==', 'Untuk mobil di harga Rp160 jutaan, Toyota Calya terbilang punya fitur-fitur kenyamanan yang lengkap. Contohnya power window, pengaturan spion yang bisa dilipat elektrik, head unit layar sentuh, 2 buah airbag, Bluetooth, konektifitas iPhone, USB, AUX, sensor parkir mundur, dan rem ABS.', 'gambar1_2023-11-16-12-10-24.jpg', 'gambar2_2023-11-16-12-10-24.jpg', 'gambar3_2023-11-16-12-10-24.jpg', 'gambar4_2023-11-16-12-10-24.PNG', 'gambar5_2023-11-16-12-10-24.png', 'gambar6_2023-11-16-12-10-24.jpg', '2023-11-16 05:10:24', '2023-12-03 02:59:48'),
(7, 1, 3, 'Brio', 'J232SDD', 'JH62323', 'JKWEWE1', '2015', 7, 3, 1, 1, 5, '119994', 1, 50000000, 12000000, 110000000, '2023-11-16', 0, 'HUNS', 1, 1, 'https://www.youtube.com/watch?v=PwwHEia9gp8', 'https://www.instagram.com/p/CzGP6fLNkNs/?utm_source=ig_web_copy_link&igshid=MzRlODBiNWFlZA==', NULL, 'Honda Brio diluncurkan di Indonesia pada bulan Agustus 2012, dengan harga ketika peluncuran berkisar antara 149-170 juta rupiah.', 'gambar1_2023-11-16-12-18-15.jpg', 'gambar2_2023-11-16-12-18-15.jpg', 'gambar3_2023-11-16-12-18-15.jpg', 'gambar4_2023-11-16-12-18-15.jpg', 'gambar5_2023-11-16-12-18-15.jpg', 'gambar6_2023-11-16-12-18-15.jpg', '2023-11-16 05:18:15', '2023-12-01 05:55:24'),
(8, 4, 1, 'Fortuner', 'H232DSS', 'JKK2323SD', 'KLK3223D', '2019', 10, 1, 1, 1, 5, '449999', 1, 300000000, 23000000, 450000000, '2023-11-16', 5000000, 'HUNS', 1, 1, 'https://www.youtube.com/watch?v=BgEthZ21K9U', 'https://www.instagram.com/p/Cy5fhzoi7Mm/?utm_source=ig_web_copy_link&igshid=MzRlODBiNWFlZA==', NULL, 'Toyota Fortuner adalah mobil SUV dari produsen asal Jepang, Toyota. Mobil ini telah dipasarkan sejak tahun 2005 di Indonesia dan negara Asia Tenggara lainnya. Mobil ini dibuat berdasarkan platform IMV yang terdiri dari Toyota Hilux atau disebut juga dengan Toyota Hilux Vigo di Thailand, dan Toyota Kijang Innova di Indonesia', 'gambar1_2023-11-16-12-23-15.jpg', 'gambar2_2023-11-16-12-23-15.jpg', 'gambar3_2023-11-16-12-23-15.jpg', 'gambar4_2023-11-16-12-23-15.jpg', 'gambar5_2023-11-16-12-23-15.jpg', 'gambar6_2023-11-16-12-23-15.jpg', '2023-11-16 05:23:15', '2023-12-03 01:01:45'),
(9, 5, 1, 'Pajero Sport', 'JK323', 'J3232323', 'LKSD2323', '2019', 16, 1, 1, 3, 5, '239999', 1, 450000000, 5000000, 500000000, '2023-11-16', 10000000, 'HUNS', 0, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RF0G4sv1L3o?si=o8gnowdcVNsPz8gC\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '<blockquote class=\"instagram-media\" data-instgrm-permalink=\"https://www.instagram.com/p/CyhrfT8vAF5/?utm_source=ig_embed&amp;utm_campaign=loading\" data-instgrm-version=\"14\" style=\" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);\"><div style=\"padding:16px;\"> <a href=\"https://www.instagram.com/p/CyhrfT8vAF5/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;\" target=\"_blank\"> <div style=\" display: flex; flex-direction: row; align-items: center;\"> <div style=\"background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;\"></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;\"></div></div></div><div style=\"padding: 19% 0;\"></div> <div style=\"display:block; height:50px; margin:0 auto 12px; width:50px;\"><svg width=\"50px\" height=\"50px\" viewBox=\"0 0 60 60\" version=\"1.1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\"><g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\"><g transform=\"translate(-511.000000, -20.000000)\" fill=\"#000000\"><g><path d=\"M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631\"></path></g></g></g></svg></div><div style=\"padding-top: 8px;\"> <div style=\" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;\">View this post on Instagram</div></div><div style=\"padding: 12.5% 0;\"></div> <div style=\"display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;\"><div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);\"></div> <div style=\"background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;\"></div> <div style=\"background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);\"></div></div><div style=\"margin-left: 8px;\"> <div style=\" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;\"></div> <div style=\" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)\"></div></div><div style=\"margin-left: auto;\"> <div style=\" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);\"></div> <div style=\" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);\"></div> <div style=\" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);\"></div></div></div> <div style=\"display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;\"> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;\"></div> <div style=\" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;\"></div></div></a><p style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;\"><a href=\"https://www.instagram.com/p/CyhrfT8vAF5/?utm_source=ig_embed&amp;utm_campaign=loading\" style=\" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;\" target=\"_blank\">A post shared by Jual MobKas DP Mulai 15jutaan (@rizkimotorkudus)</a></p></div></blockquote> <script async src=\"//www.instagram.com/embed.js\"></script>', '<iframe src=\"https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fjualbelimobkas%2Fposts%2Fpfbid02Zi1tqBb2xoyyZcs7U7VrS3HNpdawRiBJdcBsh5ymfUMxa575gWszSSsxhJaqcYZZl&show_text=true&width=500\" width=\"500\" height=\"786\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share\"></iframe>', 'Mulai diproduksi di Jepang tahun 1996, dan mulai diekspor keluar tahun 1997. Di beberapa negara, mobil ini dinamai berbeda, seperti Nativa (Amerika Tengah), Montero Sport (Amerika Utara), Shogun Sport (Inggris), dan G-Wagon (Thailand). Semakin meningkatnya popularitas mobil ini, maka Mitsubishi membuat pabrik perakitan di China tahun 2003.', 'gambar1_2023-11-16-12-29-07.jpg', 'gambar2_2023-11-16-12-29-07.jpg', 'gambar3_2023-11-16-12-29-07.jpg', 'gambar4_2023-11-16-12-29-07.jpg', 'gambar5_2023-11-16-12-29-07.jpg', 'gambar6_2023-11-16-12-29-07.jpg', '2023-11-16 05:29:07', '2023-12-03 00:56:29');

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
-- Table structure for table `notification_admin`
--

CREATE TABLE `notification_admin` (
  `notif_id` bigint NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = belum dibaca\r\n1 = telah dibaca',
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
(5, 'Owner', 'owner@gmail.com', '$2y$10$rqFkyRgg2lVFWZJTRDadh.o3QXMpxhszOnU2zMgIbTBr9N04qCzdG', 1, 'default.png', '2023-11-11 07:33:27', '2023-12-01 14:40:50');

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

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` bigint NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `mobil_id` bigint NOT NULL,
  `review_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `star` float NOT NULL,
  `image1` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image2` varchar(150) DEFAULT NULL,
  `image3` varchar(150) DEFAULT NULL,
  `image4` varchar(150) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 = aktif\r\n0 = tidak aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_id`, `mobil_id`, `review_text`, `star`, `image1`, `image2`, `image3`, `image4`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 9, 'Harga bersaing, aplikasi bagus.', 5, 'RVW-1-9.png', NULL, NULL, NULL, 1, '2023-12-03 00:57:28', NULL);

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
  `biaya_pengiriman` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 'Manual', '2023-11-04 14:36:11', '2023-11-16 05:19:09'),
(3, 'Auto', '2023-11-16 05:19:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `nama_lengkap` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_hp` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `sign_in` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif\r\n0 = tidak aktif',
  `profile_photo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default.png',
  `token_password` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(20, 'Hitam Glossy Pekat', '2023-11-04 04:48:00', NULL),
(22, 'Gold', '2023-12-01 01:25:56', NULL);

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
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_id`);

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
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

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
-- Indexes for table `notification_admin`
--
ALTER TABLE `notification_admin`
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
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

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
  MODIFY `bahan_bakar_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `bank_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `body`
--
ALTER TABLE `body`
  MODIFY `body_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `finance_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kapasitas_mesin`
--
ALTER TABLE `kapasitas_mesin`
  MODIFY `km_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kapasitas_penumpang`
--
ALTER TABLE `kapasitas_penumpang`
  MODIFY `kp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `karyawan_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `merk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `mobil_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_admin`
--
ALTER TABLE `notification_admin`
  MODIFY `notif_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tangki`
--
ALTER TABLE `tangki`
  MODIFY `tangki_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transmisi`
--
ALTER TABLE `transmisi`
  MODIFY `transmisi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `warna_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
