-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2020 at 04:19 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_cerdas`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_proposals`
--

DROP TABLE IF EXISTS `dokumen_proposals`;
CREATE TABLE IF NOT EXISTS `dokumen_proposals` (
  `id_proposal` int(10) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(10) NOT NULL,
  `nama_dokumen` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_dokumen` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_dokumen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id_proposal`),
  KEY `id_mahasiswa` (`id_mahasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen_proposals`
--

INSERT INTO `dokumen_proposals` (`id_proposal`, `id_mahasiswa`, `nama_dokumen`, `tipe_dokumen`, `link_dokumen`, `keterangan`, `updated_at`, `created_at`) VALUES
(16, 3, 'brosur baksos.docx', 'docx', 'dokumen_proposal/brosur baksos.docx', 'aaaa', '2020-06-22 11:58:11', '2020-06-22 11:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_proposal`
--

DROP TABLE IF EXISTS `komentar_proposal`;
CREATE TABLE IF NOT EXISTS `komentar_proposal` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `id_proposal` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `teks_komentar` text NOT NULL,
  `kategori_komentar` varchar(30) NOT NULL,
  `tgl_komentar` date NOT NULL,
  PRIMARY KEY (`id_komentar`),
  KEY `id_proposal` (`id_proposal`),
  KEY `id_pembimbing` (`id_pembimbing`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar_proposal`
--

INSERT INTO `komentar_proposal` (`id_komentar`, `id_proposal`, `id_pembimbing`, `teks_komentar`, `kategori_komentar`, `tgl_komentar`) VALUES
(1, 16, 2, 'muantaps', 'content-related', '2020-06-23'),
(2, 16, 2, 'bagus', 'non content-related', '2020-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `mhs_bimbingan`
--

DROP TABLE IF EXISTS `mhs_bimbingan`;
CREATE TABLE IF NOT EXISTS `mhs_bimbingan` (
  `id_mhs_bimbingan` int(10) NOT NULL AUTO_INCREMENT,
  `id_pembimbing` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `status_revisi` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id_mhs_bimbingan`),
  KEY `mhs_bimbingan_ibfk_1` (`id_pembimbing`),
  KEY `mhs_bimbingan_ibfk_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs_bimbingan`
--

INSERT INTO `mhs_bimbingan` (`id_mhs_bimbingan`, `id_pembimbing`, `id`, `status_revisi`, `created_at`, `updated_at`) VALUES
(15, 2, 3, 'Belum Revisi', '2020-06-22 23:29:50', '2020-06-22 23:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2020_03_12_013244_create_dokumen_proposal', 1),
(3, '2020_03_12_015946_create_dokumen_proposals_table', 2),
(8, '2017_09_18_125450_create_user_roles_table', 3),
(9, '2017_09_18_130600_create_roles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petunjuk_revisi`
--

DROP TABLE IF EXISTS `petunjuk_revisi`;
CREATE TABLE IF NOT EXISTS `petunjuk_revisi` (
  `id_petunjuk` int(10) NOT NULL AUTO_INCREMENT,
  `id_komentar` int(10) NOT NULL,
  `teks_petunjuk_revisi` text NOT NULL,
  PRIMARY KEY (`id_petunjuk`),
  KEY `fk_id_komentar` (`id_komentar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES
(1, 'firdamdam', 'firdamdamsasmita@upi.edu', '$2y$10$BqlkUZGUHsuiPSH8ERyb1etgqK1bGbd6KRKikHpjAxCybZOu7hgMG', 'GMCc5mCOf8seGjSIDjxbQWIdMH2CogIBu742f6KBmdZ91t9NcKBu731QOhjG', '2020-03-04 01:04:32', '2020-03-04 01:04:32', 'mahasiswa'),
(2, 'Pa Ahmad', 'ahmad123@gmail.com', '$2y$10$BqlkUZGUHsuiPSH8ERyb1etgqK1bGbd6KRKikHpjAxCybZOu7hgMG', 'm7hcBvmqzd8tX0wUSMHoIYmQQTSJ7L2eKfAKPZdaR1KUYtg18EBuMieXHtif', '2020-03-04 01:04:32', '2020-03-04 01:04:32', 'pembimbing'),
(3, 'agung setiawan', 'setiawan123@gmail.com', '$2y$10$BqlkUZGUHsuiPSH8ERyb1etgqK1bGbd6KRKikHpjAxCybZOu7hgMG', 'Y6bwpV1IWhVTS24erZhkHSFOPLYVZYM4CheXm2xfhMU3PLEpyRqDpjhmVDLj', '2020-03-04 01:04:32', '2020-03-04 01:04:32', 'mahasiswa');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_proposals`
--
ALTER TABLE `dokumen_proposals`
  ADD CONSTRAINT `fk_id_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar_proposal`
--
ALTER TABLE `komentar_proposal`
  ADD CONSTRAINT `fk_id_pembimbing` FOREIGN KEY (`id_pembimbing`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_proposal` FOREIGN KEY (`id_proposal`) REFERENCES `dokumen_proposals` (`id_proposal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhs_bimbingan`
--
ALTER TABLE `mhs_bimbingan`
  ADD CONSTRAINT `mhs_bimbingan_ibfk_1` FOREIGN KEY (`id_pembimbing`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_bimbingan_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petunjuk_revisi`
--
ALTER TABLE `petunjuk_revisi`
  ADD CONSTRAINT `fk_id_komentar` FOREIGN KEY (`id_komentar`) REFERENCES `komentar_proposal` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
