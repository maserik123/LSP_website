-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 23, 2021 at 12:01 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-34+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `b_notif`
--

CREATE TABLE `b_notif` (
  `notif_id` int(11) NOT NULL,
  `jenis_notif` varchar(11) NOT NULL,
  `notif_isi` varchar(112) NOT NULL,
  `notif_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notif_status` int(11) NOT NULL DEFAULT '0',
  `notif_fitur` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_user_log`
--

CREATE TABLE `b_user_log` (
  `log_id` int(11) NOT NULL,
  `jenis_aksi` enum('add_data','update_data','delete_data','login','logout','') NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `ip_addr` varchar(17) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_user_log`
--

INSERT INTO `b_user_log` (`log_id`, `jenis_aksi`, `keterangan`, `tgl`, `status`, `ip_addr`, `user_id`) VALUES
(1, '', 'Fitra Arrafiq Logout dari System', '2021-03-21 06:31:59', 1, '::1', 7),
(2, '', 'Fitra Official Login ke System', '2021-03-21 06:32:09', 1, '::1', 3),
(3, 'update_data', 'Fitra Official Menerima Konfirmasi pada data permintaan APL01 dengan ID 8', '2021-03-21 06:33:06', 1, '::1', 3),
(4, 'update_data', 'Fitra Official Melengkapi Dokumen Asesor dengan ID data 8', '2021-03-21 06:33:22', 1, '::1', 3),
(5, '', 'Fitra Official Logout dari System', '2021-03-21 06:33:57', 1, '::1', 3),
(6, '', 'Fitra Arrafiq Login ke System', '2021-03-21 06:34:08', 1, '::1', 7),
(7, 'add_data', 'Fitra Arrafiq Menambahkan data pada tabel apl_02_finish 8', '2021-03-21 06:34:24', 1, '::1', 7),
(8, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:35', 1, '::1', 7),
(9, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(10, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(11, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(12, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(13, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(14, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(15, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(16, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:36', 1, '::1', 7),
(17, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:37', 1, '::1', 7),
(18, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:37', 1, '::1', 7),
(19, 'add_data', 'Fitra Arrafiq Menambahkan data pada asesmen mandiri untuk pilihan skema8', '2021-03-21 06:37:38', 1, '::1', 7),
(20, '', 'Fitra Arrafiq Logout dari System', '2021-03-21 06:38:08', 1, '::1', 7),
(21, '', 'Amalya Amalya Login ke System', '2021-03-21 06:38:40', 1, '::1', 5),
(22, 'update_data', 'Amalya Amalya Mengubah data apl_02_finish dengan id skema pilihan 8', '2021-03-21 06:39:30', 1, '::1', 5),
(23, '', 'Amalya Amalya Login ke System', '2021-03-21 15:55:25', 1, '::1', 5),
(24, '', 'Amalya Amalya Logout dari System', '2021-03-21 20:13:13', 1, '::1', 5),
(25, '', 'Amalya Amalya Login ke System', '2021-03-21 21:26:12', 1, '::1', 5),
(26, '', 'Fitra Arrafiq Login ke System', '2021-03-22 03:55:28', 1, '::1', 7),
(27, '', 'Fitra Arrafiq Logout dari System', '2021-03-22 04:13:06', 1, '::1', 7),
(28, '', 'Amalya Amalya Login ke System', '2021-03-22 04:13:18', 1, '::1', 5),
(29, '', 'Amalya Amalya Login ke System', '2021-03-22 08:08:47', 1, '::1', 5),
(30, '', 'Amalya Amalya Logout dari System', '2021-03-22 08:11:41', 1, '::1', 5),
(31, '', 'Fitra Official Login ke System', '2021-03-22 08:11:49', 1, '::1', 3),
(32, '', 'Fitra Official Logout dari System', '2021-03-22 08:15:00', 1, '::1', 3),
(33, '', 'Amalya Amalya Login ke System', '2021-03-22 08:15:12', 1, '::1', 5),
(34, '', 'Fitra Official Login ke System', '2021-03-22 08:23:37', 1, '127.0.0.1', 3),
(35, '', 'Amalya Amalya Logout dari System', '2021-03-22 10:09:26', 1, '::1', 5),
(36, '', 'Fitra Official Logout dari System', '2021-03-22 12:00:04', 1, '127.0.0.1', 3),
(37, '', 'Fitra Official Login ke System', '2021-03-22 12:00:23', 1, '::1', 3),
(38, 'add_data', 'Fitra Official Menambahkan data tentang judul Tentang LSP Politeknik Caltex Riau', '2021-03-22 13:57:12', 1, '::1', 3),
(39, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 1', '2021-03-22 14:01:37', 1, '::1', 3),
(40, 'add_data', 'Fitra Official Menambahkan data tentang judul asdasd', '2021-03-22 14:21:27', 1, '::1', 3),
(41, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 2', '2021-03-22 14:22:00', 1, '::1', 3),
(42, 'add_data', 'Fitra Official Menambahkan data tentang judul asadasd', '2021-03-22 14:22:10', 1, '::1', 3),
(43, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 3', '2021-03-22 14:22:29', 1, '::1', 3),
(44, 'add_data', 'Fitra Official Menambahkan data tentang judul Tentang LSP Politeknik Caltex Riau', '2021-03-22 14:22:45', 1, '::1', 3),
(45, 'update_data', 'Fitra Official Mengubah data tentang dengan ID 4', '2021-03-22 14:22:57', 1, '::1', 3),
(46, 'update_data', 'Fitra Official Mengubah data tentang dengan ID 4', '2021-03-22 14:23:07', 1, '::1', 3),
(47, '', 'Fitra Official Logout dari System', '2021-03-22 15:16:05', 1, '::1', 3),
(48, '', 'Fitra Official Login ke System', '2021-03-22 16:54:29', 1, '::1', 3),
(49, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 6', '2021-03-22 16:56:58', 1, '::1', 3),
(50, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 5', '2021-03-22 16:57:01', 1, '::1', 3),
(51, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 4', '2021-03-22 16:57:03', 1, '::1', 3),
(52, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 3', '2021-03-22 16:57:07', 1, '::1', 3),
(53, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 2', '2021-03-22 16:57:10', 1, '::1', 3),
(54, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 1', '2021-03-22 16:57:18', 1, '::1', 3),
(55, '', 'Fitra Official Logout dari System', '2021-03-22 16:57:31', 1, '::1', 3),
(56, '', 'Fitra Official Login ke System', '2021-03-22 17:05:13', 1, '::1', 3),
(57, '', 'Fitra Official Logout dari System', '2021-03-22 17:08:51', 1, '::1', 3),
(58, '', 'Fitra Arrafiq Login ke System', '2021-03-22 17:10:31', 1, '::1', 7),
(59, '', 'Fitra Arrafiq Logout dari System', '2021-03-22 17:10:58', 1, '::1', 7),
(60, '', 'Fitra Official Login ke System', '2021-03-22 17:18:27', 1, '::1', 3),
(61, 'delete_data', 'Fitra Official Menghapus data tentang dengan ID 7', '2021-03-22 17:21:01', 1, '::1', 3),
(62, '', 'Fitra Official Logout dari System', '2021-03-22 17:21:26', 1, '::1', 3),
(63, '', 'Fitra Arrafiq Login ke System', '2021-03-22 17:21:34', 1, '::1', 7),
(64, '', 'Fitra Arrafiq Logout dari System', '2021-03-22 17:22:00', 1, '::1', 7),
(65, '', 'Amalya Amalya Login ke System', '2021-03-22 17:22:07', 1, '::1', 5),
(66, '', 'Amalya Amalya Logout dari System', '2021-03-22 17:23:55', 1, '::1', 5),
(67, '', 'Fitra Official Login ke System', '2021-03-22 17:24:03', 1, '::1', 3),
(68, '', 'Fitra Official Logout dari System', '2021-03-22 17:24:17', 1, '::1', 3),
(69, '', 'Amalya Amalya Login ke System', '2021-03-22 17:24:24', 1, '::1', 5),
(70, '', 'Amalya Amalya Logout dari System', '2021-03-22 17:45:02', 1, '::1', 5),
(71, '', 'Fitra Official Login ke System', '2021-03-22 17:46:06', 1, '::1', 3),
(72, '', 'Fitra Official Logout dari System', '2021-03-22 17:46:20', 1, '::1', 3),
(73, '', 'Fitra Official Login ke System', '2021-03-22 17:50:15', 1, '::1', 3),
(74, '', 'Fitra Official Logout dari System', '2021-03-22 17:51:58', 1, '::1', 3),
(75, '', 'Fitra Official Login ke System', '2021-03-22 17:55:01', 1, '::1', 3),
(76, '', 'Fitra Official Logout dari System', '2021-03-22 17:56:24', 1, '::1', 3),
(77, '', 'Amalya Amalya Login ke System', '2021-03-22 17:56:33', 1, '::1', 5),
(78, '', 'Amalya Amalya Logout dari System', '2021-03-22 18:13:51', 1, '::1', 5),
(79, '', 'Fitra Official Login ke System', '2021-03-22 18:16:01', 1, '::1', 3),
(80, '', 'Fitra Official Logout dari System', '2021-03-22 18:16:08', 1, '::1', 3),
(81, '', 'Amalya Amalya Login ke System', '2021-03-22 18:16:15', 1, '::1', 5),
(82, 'add_data', 'Amalya Amalya Menambahkan data skema baru dengan judul Istianah Muslim', '2021-03-22 19:35:31', 1, '::1', 5),
(83, 'add_data', 'Amalya Amalya Menambahkan data skema baru dengan judul Istianah Muslim', '2021-03-22 19:35:56', 1, '::1', 5),
(84, 'update_data', 'Amalya Amalya Mengubah password dengan ID 5', '2021-03-22 19:36:56', 1, '::1', 5),
(85, 'update_data', 'Amalya Amalya Mengubah password dengan ID 5', '2021-03-22 19:38:14', 1, '::1', 5),
(86, '', 'Amalya Amalya Logout dari System', '2021-03-22 19:39:17', 1, '::1', 5),
(87, '', 'Fitra Official Login ke System', '2021-03-22 19:39:45', 1, '::1', 3),
(88, 'update_data', 'Fitra Official Mengupload Tanda Tangan admin untuk keperluan APL 01 pada ID data ', '2021-03-22 19:43:25', 1, '::1', 3),
(89, 'update_data', 'Fitra Official Mengubah password dengan ID 3', '2021-03-22 19:49:35', 1, '::1', 3),
(90, '', 'Fitra Official Logout dari System', '2021-03-22 19:49:58', 1, '::1', 3),
(91, '', 'Fitra Official Login ke System', '2021-03-22 19:52:26', 1, '::1', 3),
(92, 'update_data', 'Fitra Official Mengubah password dengan ID 3', '2021-03-22 19:52:43', 1, '::1', 3),
(93, 'update_data', 'Fitra Official Mengubah password dengan ID 3', '2021-03-22 19:53:13', 1, '::1', 3),
(94, '', 'Fitra Official Logout dari System', '2021-03-22 19:53:19', 1, '::1', 3),
(95, '', 'Fitra Official Login ke System', '2021-03-22 19:53:34', 1, '::1', 3),
(96, '', 'Fitra Official Logout dari System', '2021-03-22 19:53:52', 1, '::1', 3),
(97, '', 'Fitra Official Login ke System', '2021-03-22 19:54:00', 1, '::1', 3),
(98, '', 'Fitra Official Logout dari System', '2021-03-22 19:56:06', 1, '::1', 3),
(99, '', 'Amalya Amalya Login ke System', '2021-03-22 19:56:56', 1, '::1', 5),
(100, '', 'Amalya Amalya Logout dari System', '2021-03-22 19:57:44', 1, '::1', 5),
(101, '', 'Satria Dharma Login ke System', '2021-03-22 19:59:20', 1, '::1', 6),
(102, '', 'Satria Dharma Logout dari System', '2021-03-22 20:11:51', 1, '::1', 6),
(103, '', 'Fitra Official Login ke System', '2021-03-22 20:15:46', 1, '::1', 3),
(104, '', 'Fitra Official Logout dari System', '2021-03-22 20:19:54', 1, '::1', 3),
(105, '', 'Fitra Official Login ke System', '2021-03-22 20:20:11', 1, '::1', 3),
(106, '', 'Fitra Official Login ke System', '2021-03-23 06:25:12', 1, '::1', 3),
(107, 'update_data', 'Fitra Official Mengupload Tanda Tangan admin untuk keperluan APL 01 pada ID data ', '2021-03-23 11:43:30', 1, '::1', 3),
(108, 'update_data', 'Fitra Official Menerima Konfirmasi pada data permintaan APL01 dengan ID 8', '2021-03-23 11:43:52', 1, '::1', 3),
(109, 'update_data', 'Fitra Official Melengkapi Dokumen Asesor dengan ID data 8', '2021-03-23 11:44:11', 1, '::1', 3),
(110, 'update_data', 'Fitra Official Melengkapi Dokumen Asesor dengan ID data 8', '2021-03-23 11:53:34', 1, '::1', 3),
(111, 'update_data', 'Fitra Official Menerima Konfirmasi pada data permintaan APL01 dengan ID 8', '2021-03-23 11:54:04', 1, '::1', 3),
(112, 'update_data', 'Fitra Official Melengkapi Dokumen Asesor dengan ID data 8', '2021-03-23 11:54:15', 1, '::1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_apl_02`
--

CREATE TABLE `tb_apl_02` (
  `id` int(11) NOT NULL,
  `id_pilihan_skema` int(11) NOT NULL,
  `id_unit_kompetensi` int(11) NOT NULL,
  `judul_unit_kompetensi` text NOT NULL,
  `id_skema` int(11) NOT NULL,
  `judul_skema` text NOT NULL,
  `id_unit_elemen` int(11) NOT NULL,
  `judul_unit_elemen` text NOT NULL,
  `id_unit_pertanyaan_elemen` int(11) NOT NULL,
  `daftar_pertanyaan` text NOT NULL,
  `penilaian_kompeten` text NOT NULL,
  `bukti_kompeten` text NOT NULL,
  `asesor_v` text NOT NULL,
  `asesor_a` text NOT NULL,
  `asesor_t` text NOT NULL,
  `asesor_m` text NOT NULL,
  `create_date` date NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_apl_02`
--

INSERT INTO `tb_apl_02` (`id`, `id_pilihan_skema`, `id_unit_kompetensi`, `judul_unit_kompetensi`, `id_skema`, `judul_skema`, `id_unit_elemen`, `judul_unit_elemen`, `id_unit_pertanyaan_elemen`, `daftar_pertanyaan`, `penilaian_kompeten`, `bukti_kompeten`, `asesor_v`, `asesor_a`, `asesor_t`, `asesor_m`, `create_date`, `status_delete`) VALUES
(1, 8, 1, 'Menggunakan spesifikasi program', 1, 'Programmer', 1, 'Menggunakan metode pengembangan program', 1, 'Apakah anda dapat mendefinisikan metode pengembangan aplikasi (software development) ?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(2, 8, 1, '', 1, '', 1, '', 2, 'Apakah anda dapat memilih metode pengembangan aplikasi (software development) sesuai kebutuhan?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(3, 8, 1, '', 1, '', 2, 'Menggunakan diagram program dan deskripsi program', 3, 'Apakah anda dapat mendefinisikan diagram program dengan metodologi pengembangan sistem?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(4, 8, 1, '', 1, '', 2, '', 4, 'Apakah anda dapat menggunakan metode pemodelan, diagram objek dan diagram komponen pada implementasi program sesuai dengan spesifikasi?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(5, 8, 1, '', 1, '', 3, 'Menerapkan hasil pemodelan ke dalam pengembangan program', 5, 'Apakah anda dapat memilih hasil pemodelan yang mendukung kemampuan metodologi sesuai\r\nspesifikasi?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(6, 8, 1, '', 1, '', 3, '', 6, 'Apakah anda dapat memilih Hasil pemrograman (Integrated Development Environment-IDE) yang\r\nmendukung kemampuan metodologi bahasa pemrograman sesuai spesifikasi?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(7, 8, 2, 'Menulis kode dengan prinsip sesuai guidelines dan best practices.', 1, '', 4, 'Menerapkan coding-guidelines dan best practices dalam penulisan program (kode sumber)', 7, 'Apakah anda dapat menuliskan kode sumber mengikuti coding-guidelines dan best practice?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(8, 8, 2, '', 1, '', 4, '', 8, 'Apakah anda dapat membuat Struktur program yang sesuai dengan konsep paradigmanya?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(9, 8, 2, '', 1, '', 4, '', 9, 'Apakah anda dapat menangani galat/error?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(10, 8, 2, '', 1, '', 5, 'Menggunakan ukuran performansi dalam menuliskan kode sumber', 10, 'Apakah anda dapat menghitung Efisiensi penggunaan resources oleh kode?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(11, 8, 2, '', 1, '', 5, '', 11, 'Apakah anda dapat mengimplementasikan kemudahan interaksi selalu sesuai standar yang berlaku?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0),
(12, 8, 3, 'Mengimplementasikan pemrograman terstruktur.', 1, '', 6, 'Menggunakan tipe data dan control program', 12, 'Apakah anda dapat menentukan tipe data yang sesuai standar ?', 'Kompeten', '', '1', '1', '1', '1', '2021-03-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_apl_02_finish`
--

CREATE TABLE `tb_apl_02_finish` (
  `id` int(11) NOT NULL,
  `id_asesi` int(11) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  `tuk` text NOT NULL,
  `nama_asesor` text NOT NULL,
  `nama_asesi` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_pilihan_skema` int(11) NOT NULL,
  `judul_skema` text NOT NULL,
  `tanda_tangan_asesi` text NOT NULL,
  `tanggal_tanda_tangan_asesi` date NOT NULL,
  `no_reg` text NOT NULL,
  `tanda_tangan_asesor` text NOT NULL,
  `tanggal_tanda_tangan_asesor` text NOT NULL,
  `catatan_asesmen_portofolio` text NOT NULL,
  `catatan_uji_kompetensi` text NOT NULL,
  `create_date` date NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_apl_02_finish`
--

INSERT INTO `tb_apl_02_finish` (`id`, `id_asesi`, `id_asesor`, `tuk`, `nama_asesor`, `nama_asesi`, `tanggal`, `id_pilihan_skema`, `judul_skema`, `tanda_tangan_asesi`, `tanggal_tanda_tangan_asesi`, `no_reg`, `tanda_tangan_asesor`, `tanggal_tanda_tangan_asesor`, `catatan_asesmen_portofolio`, `catatan_uji_kompetensi`, `create_date`, `status_delete`) VALUES
(8, 10, 6, 'Sewaktu', 'Istianah Muslim', 'Fitra Arrafiq', '2021-03-21', 8, 'Programmer', '1613263244tanda_tangan.jpeg', '2021-03-21', '879879987', '1612482448Screenshot_(3).png', '2021-03-21', 'Kamu telah lulus', '', '2021-03-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_asesor`
--

CREATE TABLE `tb_asesor` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_asesor` text NOT NULL,
  `no_reg` text NOT NULL,
  `expire_date` date DEFAULT NULL,
  `tanda_tangan` text NOT NULL,
  `create_date` text NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_asesor`
--

INSERT INTO `tb_asesor` (`id`, `id_user`, `nama_asesor`, `no_reg`, `expire_date`, `tanda_tangan`, `create_date`, `status_delete`) VALUES
(6, 5, 'Istianah Muslim', '879879987', '2021-03-19', '1612482448Screenshot_(3).png', '2021-02-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact_us`
--

CREATE TABLE `tb_contact_us` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `isi_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_admin`
--

CREATE TABLE `tb_data_admin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `email` text NOT NULL,
  `tanda_tangan` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_data_admin`
--

INSERT INTO `tb_data_admin` (`id`, `id_user`, `nama_lengkap`, `email`, `tanda_tangan`, `create_date`) VALUES
(1, 3, 'Fitra Arrafiq', 'fitraarrafiq@gmail.com', '1616474610Pertemuan_dengan_bu_dini_kamis_18_maret_2021_(14).png', '2021-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_diri`
--

CREATE TABLE `tb_data_diri` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dd_nama_lengkap` text NOT NULL,
  `dd_nik` text NOT NULL,
  `dd_tempat_lahir` text NOT NULL,
  `dd_tgl_lahir` text NOT NULL,
  `dd_jenis_kelamin` text NOT NULL,
  `dd_kebangsaan` text NOT NULL,
  `dd_alamat_rumah` text NOT NULL,
  `dd_no_hp` text NOT NULL,
  `dd_no_telp` text NOT NULL,
  `dd_email` text NOT NULL,
  `dd_kode_pos` text NOT NULL,
  `dd_kantor` text NOT NULL,
  `dd_pendidikan_terakhir` text NOT NULL,
  `dd_tanda_tangan_asesi` text NOT NULL,
  `dd_foto` text NOT NULL,
  `k_lembaga` text NOT NULL,
  `k_jabatan` text NOT NULL,
  `k_alamat` text NOT NULL,
  `k_kode_pos` text NOT NULL,
  `k_fax` text NOT NULL,
  `k_telp` text NOT NULL,
  `k_email` text NOT NULL,
  `create_date` date NOT NULL,
  `block_status` varchar(45) NOT NULL DEFAULT 'unblock',
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_data_diri`
--

INSERT INTO `tb_data_diri` (`id`, `id_user`, `dd_nama_lengkap`, `dd_nik`, `dd_tempat_lahir`, `dd_tgl_lahir`, `dd_jenis_kelamin`, `dd_kebangsaan`, `dd_alamat_rumah`, `dd_no_hp`, `dd_no_telp`, `dd_email`, `dd_kode_pos`, `dd_kantor`, `dd_pendidikan_terakhir`, `dd_tanda_tangan_asesi`, `dd_foto`, `k_lembaga`, `k_jabatan`, `k_alamat`, `k_kode_pos`, `k_fax`, `k_telp`, `k_email`, `create_date`, `block_status`, `status_delete`) VALUES
(10, 7, 'Fitra Arrafiq', '1407050202980003', 'Bagan Batu', '2021-01-27', 'laki-laki', 'Indonesia', 'Jl.Telagasari', '082390091029', '0823922111', 'fitra_arrafiq@alumni.pcr.ac.id', '12332', '0822993322', 'S1/D4', '1613263244tanda_tangan.jpeg', '1613263277fitra_arrafiq.jpg', 'assss', 'ddd', '', '', '0', '0', '-', '2021-03-06', 'unblock', 0),
(11, 6, 'Satria Dharma', '12345663234676666', 'Pekanbaru, Jalan Merdeka', '2021-01-25', 'perempuan', 'Indonesia', 'Jl. Barau-Barau', '081371833321', '0', 'satria.novrianto@gmail.com', '28772', '', 'SMA/SMK', '1612224193Screenshot_Kamis_7_januari.png', '', '', '', '', '', '', '', '', '2021-01-31', 'unblock', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id` int(11) NOT NULL,
  `id_skema` int(11) NOT NULL,
  `mulai_daftar` date NOT NULL,
  `akhir_daftar` date NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `create_date` date NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id`, `id_skema`, `mulai_daftar`, `akhir_daftar`, `tanggal_pelaksanaan`, `create_date`, `status_delete`) VALUES
(2, 1, '2021-03-01', '2021-03-31', '2021-02-02', '2021-03-05', 0),
(3, 3, '2021-03-01', '2021-03-31', '2021-01-25', '2021-03-14', 0),
(6, 5, '2021-03-01', '2021-03-31', '0000-00-00', '2021-03-14', 0),
(7, 2, '2021-03-01', '2021-03-31', '0000-00-00', '2021-03-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemberitahuan`
--

CREATE TABLE `tb_pemberitahuan` (
  `id` int(11) NOT NULL,
  `pemberitahuan` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pilihan_skema`
--

CREATE TABLE `tb_pilihan_skema` (
  `id` int(11) NOT NULL,
  `id_data_diri` int(11) NOT NULL,
  `id_skema` int(11) NOT NULL,
  `tujuan_sertifikasi` text NOT NULL,
  `upload_ktm` text NOT NULL,
  `upload_transkrip` text NOT NULL,
  `upload_ktp_sim` text NOT NULL,
  `sertifikat_pelatihan` text NOT NULL,
  `upload_pengalaman_kerja` text NOT NULL,
  `upload_bukti_relevan_1` text NOT NULL,
  `keterangan_bukti_1` text NOT NULL,
  `upload_bukti_relevan_2` text NOT NULL,
  `keterangan_bukti_2` text NOT NULL,
  `upload_bukti_relevan_3` text NOT NULL,
  `keterangan_bukti_3` text NOT NULL,
  `upload_bukti_relevan_4` text NOT NULL,
  `keterangan_bukti_4` text NOT NULL,
  `upload_bukti_relevan_5` text NOT NULL,
  `keterangan_bukti_5` text NOT NULL,
  `tanda_tangan_asesi` text NOT NULL,
  `tanda_tangan_asesor` text NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tutup_pendaftaran` date NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `id_asesor` varchar(11) NOT NULL,
  `id_user_admin` int(11) NOT NULL,
  `nik_lsp` text NOT NULL,
  `tanda_tangan_admin` text NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `status_diterima` int(11) NOT NULL,
  `status_dokumen` int(11) NOT NULL,
  `keterangan_status` text NOT NULL,
  `status_selesai` varchar(11) NOT NULL DEFAULT 'on_progres',
  `status_delete` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pilihan_skema`
--

INSERT INTO `tb_pilihan_skema` (`id`, `id_data_diri`, `id_skema`, `tujuan_sertifikasi`, `upload_ktm`, `upload_transkrip`, `upload_ktp_sim`, `sertifikat_pelatihan`, `upload_pengalaman_kerja`, `upload_bukti_relevan_1`, `keterangan_bukti_1`, `upload_bukti_relevan_2`, `keterangan_bukti_2`, `upload_bukti_relevan_3`, `keterangan_bukti_3`, `upload_bukti_relevan_4`, `keterangan_bukti_4`, `upload_bukti_relevan_5`, `keterangan_bukti_5`, `tanda_tangan_asesi`, `tanda_tangan_asesor`, `tanggal_pengajuan`, `tutup_pendaftaran`, `tanggal_pelaksanaan`, `id_asesor`, `id_user_admin`, `nik_lsp`, `tanda_tangan_admin`, `tanggal_diterima`, `status_diterima`, `status_dokumen`, `keterangan_status`, `status_selesai`, `status_delete`, `create_date`) VALUES
(8, 10, 1, 'sertifikasi', '1616283090Screenshot_(12).png', '1616283098PertemuanAwal2SIDDatawarehouse_(12).png', '1616283105Pertemuan_dengan_bu_dini_kamis_18_maret_2021_(14).png', '', '', '', '', '', '', '', '', '', '', '', '', '1613263244tanda_tangan.jpeg', '', '2021-03-21', '2021-03-31', '0000-00-00', '6', 3, '564-ID', '1616474610Pertemuan_dengan_bu_dini_kamis_18_maret_2021_(14).png', '2021-03-23', 1, 1, '', 'selesai', 0, '2021-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_skema`
--

CREATE TABLE `tb_skema` (
  `id` int(11) NOT NULL,
  `judul_skema` text NOT NULL,
  `no_skema` text NOT NULL,
  `delete_status` int(11) NOT NULL,
  `create_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_skema`
--

INSERT INTO `tb_skema` (`id`, `judul_skema`, `no_skema`, `delete_status`, `create_date`) VALUES
(1, 'Programmer', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(2, 'Teknisi Madya Jaringan Komputer', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(3, 'Junior Network & Administrator', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(4, 'Database Programmer Supervisor', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(5, 'Teknisi Akuntansi Pratama', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(6, 'Pengoperasian Peralatan Kelistrikan dan Elektronika Berbasis PLC', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(7, 'Juru Las 1 SMAW', 'SKM-LSP.PCR/05/2018', 0, '2021-01-11'),
(8, 'Juru Las 2 SMAW', 'SKM-LSP.PCR/05/2018', 0, '2021-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tentang`
--

CREATE TABLE `tb_tentang` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tentang`
--

INSERT INTO `tb_tentang` (`id`, `judul`, `isi`, `create_date`) VALUES
(4, 'Tentang LSP Politeknik Caltex Riau', '<p>Lembaga Sertifikasi Profesi Pihak Pertama Politeknik Caltex Riau (LSP-P1 PCR) merupakan pelaksanaan hasil rekomendasi berdasarkan lisensi dari Badan Nasional Sertifikasi Profesi (BNSP) Nomor Surat Keputusan: <strong>065B/BNSP/V/2016</strong> dengan nomor lisensi <strong>BNSP-LSP-564-ID</strong>. LSP-P1 PCR bertujuan untuk melakukan sertifikasi sumber daya manusia pada berbagai sektor yang dibutuhkan dunia industri sesuai dengan SKKNI dan KKNI. LSP-P1 PCR mempunyai tugas mengembangkan standar kompetensi, melaksanakan uji kompetensi, menerbitkan sertifikat kompetensi serta melakukan verifikasi tempat uji kompetensi di lingkungan PCR dengan mengusung peningkatan kompetensi mahasiswa/lulusan sesuai dengan profesi yang bisa menjadi output pendidikan dari skema-skema yang ditawarkan berdasarkan program studi-program studi yang ada di PCR.</p>\r\n\r\n<p>LSP-P1 PCR bertempat di Kampus PCR yang beralamat di Jl. Umban Sari No. 1 Rumbai, Pekanbaru 28265 Riau, memperoleh dukungan dari berbagai pemangku kepentingan (<em>Stakeholder</em>). Pemangku kepentingan tersebut adalah pihak-pihak internal yang mendukung kegiatan yang dilakukan oleh LSP-P1 PCR yaitu seluruh kelompok maupun individu yang berada di dalam lingkup PCR. Selain pihak internal pemangku kepentingan LSP-P1 PCR ini adalah pihak eksternal yang meliputi pemerintah, sektor swasta, perguruan tinggi, media, organisasi  profesi, calon peserta uji kompetensi, hingga pihak-pihak yang secara aktif memiliki keperdulian terhadap aktifitas sertifikasi profesi.</p>\r\n\r\n<p>LSP-P1 PCR dalam menjalankan aktifitasnya berada di bawah dan tentunya bernaung di dalam PCR. Berdasarkan hal tersebut maka apa yang dilakukan oleh LSP-P1 PCR adalah pengejawantahan dari Visi dan Misi Politeknik Caltex Riau.</p>\r\n\r\n<p>LSP-P1 PCR memiliki peluang menyelenggarakan uji kompetensi dengan sarana dan prasarana yang dimiliki PCR di luar kegiatan perkuliahan dan atau penjadwalan penggunaan tempat disesuaikan. Sarana dan prasarana utama berupa Laboratorium Program Studi sebagai Tempat Uji Kompetensi (TUK) Sewaktu sebagai simulasi tempat kerja dan perlengkapannya, hingga sarana dan prasarana pendukung lain seperti tempat parkir, tempat ibadah dan fasilitas umum yang berada di lingkungan kampus.</p>\r\n\r\n<p>LSP-P1 PCR merupakan pelaksanaan hasil rekomendasi berdasarkan lisensi dari BNSP No. SK: <strong>065B/BNSP/V/2016</strong> dengan No. Lisensi <strong>BNSP-LSP-564-ID.</strong></p>', '2021-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit_elemen`
--

CREATE TABLE `tb_unit_elemen` (
  `id` int(11) NOT NULL,
  `elemen_kompetensi` text NOT NULL,
  `id_unit_kompetensi` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_unit_elemen`
--

INSERT INTO `tb_unit_elemen` (`id`, `elemen_kompetensi`, `id_unit_kompetensi`, `create_date`, `status_delete`) VALUES
(1, 'Menggunakan metode pengembangan program', 1, '2021-03-20', 0),
(2, 'Menggunakan diagram program dan deskripsi program', 1, '2021-03-20', 0),
(3, 'Menerapkan hasil pemodelan ke dalam pengembangan program', 1, '2021-03-20', 0),
(4, 'Menerapkan coding-guidelines dan best practices dalam penulisan program (kode sumber)', 2, '2021-03-20', 0),
(5, 'Menggunakan ukuran performansi dalam menuliskan kode sumber', 2, '2021-03-20', 0),
(6, 'Menggunakan tipe data dan control program', 3, '2021-03-20', 0),
(7, 'Membuat program sederhana', 3, '2021-03-20', 0),
(8, 'Membuat program menggunakan prosedur dan fungsi', 3, '2021-03-20', 0),
(9, 'Membuat program menggunakan array', 3, '2021-03-20', 0),
(10, 'Membuat program untuk akses file', 3, '2021-03-20', 0),
(11, 'Mengkompilasi program', 3, '2021-03-20', 0),
(12, 'Membuat program berorientasi objek dengan memanfaatkan class', 4, '2021-03-20', 0),
(13, 'Menggunakan tipe data dan control program pada metode atau operasi dari suatu kelas', 4, '2021-03-20', 0),
(14, 'Membuat program dengan konsep berbasis objek', 4, '2021-03-20', 0),
(15, 'Membuat program object oriented dengan interface dan paket', 4, '2021-03-20', 0),
(16, 'Mengkompilasi program', 4, '2021-03-20', 0),
(17, 'Melakukan pemilihan unit-unit reuse yang potensial', 5, '2021-03-20', 0),
(18, 'Melakukan integrasi library atau komponen pre-existing dengan source code yang ada', 5, '2021-03-20', 0),
(19, 'Melakukan pembaharuan library atau komponen pre-existing yang digunakan', 5, '2021-03-20', 0),
(20, 'Membuat berbagai operasi terhadap basis data', 6, '2021-03-20', 0),
(21, 'Membuat prosedur akses terhadap basis data', 6, '2021-03-20', 0),
(22, 'Membuat koneksi basis data', 6, '2021-03-20', 0),
(23, 'Menguji program basis data', 6, '2021-03-20', 0),
(24, 'Melakukan identifikasi kode program', 7, '2021-03-20', 0),
(25, 'Membuat dokumentasi modul program', 7, '2021-03-20', 0),
(26, 'Membuat dokumentasi fungsi, prosedur atau method program', 7, '2021-03-20', 0),
(27, 'Men-generate dokumentasi', 7, '2021-03-20', 0),
(28, 'Mempersiapkan Kode Program', 8, '2021-03-20', 0),
(29, 'Melakukan Debugging', 8, '2021-03-20', 0),
(30, 'Memperbaiki Program', 8, '2021-03-20', 0),
(31, 'Menentukan kebutuhan uji coba dalam pengembangan', 9, '2021-03-20', 0),
(32, 'Mempersiapkan dokumentasi uji coba', 9, '2021-03-20', 0),
(33, 'Mempersiapkan data uji', 9, '2021-03-20', 0),
(34, 'Melaksanakan prosedur uji coba', 9, '2021-03-20', 0),
(35, 'Mengevaluasi hasil uji coba', 9, '2021-03-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit_kompetensi`
--

CREATE TABLE `tb_unit_kompetensi` (
  `id` int(11) NOT NULL,
  `id_skema` text NOT NULL,
  `kode_unit` text NOT NULL,
  `judul_unit` text NOT NULL,
  `jenis_standar` text NOT NULL,
  `create_date` date NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_unit_kompetensi`
--

INSERT INTO `tb_unit_kompetensi` (`id`, `id_skema`, `kode_unit`, `judul_unit`, `jenis_standar`, `create_date`, `status_delete`) VALUES
(1, '1', 'J.620100.009.01', 'Menggunakan spesifikasi program', 'SKKNI', '2021-03-20', 0),
(2, '1', 'J.620100.016.01', 'Menulis kode dengan prinsip sesuai guidelines dan best practices.', 'SKKNI', '2021-03-20', 0),
(3, '1', 'J.620100.017.02', 'Mengimplementasikan pemrograman terstruktur.', 'SKKNI', '2021-03-20', 0),
(4, '1', 'J.620100.018.02', 'Mengimplementasikan Pemrograman Berorientasi Objek', 'SKKNI', '2021-03-20', 0),
(5, '1', 'J.620100.019.002', 'Menggunakan Library atau Komponen Pre-Existing', 'SKKNI', '2021-03-20', 0),
(6, '1', 'J.620100.021.02', 'Menerapkan Akses Basis Data', 'SKKNI', '2021-03-20', 0),
(7, '1', 'J.620100.023.02', 'Membuat Dokumen Kode Program', 'SKKNI', '2021-03-20', 0),
(8, '1', 'J.620100.025.02', 'Melakukan Debugging', 'SKKNI', '2021-03-20', 0),
(9, '1', 'J.62010.033.02', 'Melaksanakan Pengujian Unit Program', 'SKKNI', '2021-03-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit_pertanyaan_elemen`
--

CREATE TABLE `tb_unit_pertanyaan_elemen` (
  `id` int(11) NOT NULL,
  `daftar_pertanyaan` text NOT NULL,
  `id_skema` int(11) NOT NULL,
  `judul_skema` text NOT NULL,
  `id_unit_kompetensi` int(11) NOT NULL,
  `judul_unit_kompetensi` text NOT NULL,
  `id_unit_elemen` int(11) NOT NULL,
  `judul_unit_elemen` text NOT NULL,
  `create_date` date NOT NULL,
  `status_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_unit_pertanyaan_elemen`
--

INSERT INTO `tb_unit_pertanyaan_elemen` (`id`, `daftar_pertanyaan`, `id_skema`, `judul_skema`, `id_unit_kompetensi`, `judul_unit_kompetensi`, `id_unit_elemen`, `judul_unit_elemen`, `create_date`, `status_delete`) VALUES
(1, 'Apakah anda dapat mendefinisikan metode pengembangan aplikasi (software development) ?', 1, 'Programmer', 1, 'Menggunakan spesifikasi program', 1, 'Menggunakan metode pengembangan program', '2021-03-20', 0),
(2, 'Apakah anda dapat memilih metode pengembangan aplikasi (software development) sesuai kebutuhan?', 1, '', 1, '', 1, '', '2021-03-20', 0),
(3, 'Apakah anda dapat mendefinisikan diagram program dengan metodologi pengembangan sistem?', 1, '', 1, '', 2, 'Menggunakan diagram program dan deskripsi program', '2021-03-20', 0),
(4, 'Apakah anda dapat menggunakan metode pemodelan, diagram objek dan diagram komponen pada implementasi program sesuai dengan spesifikasi?', 1, '', 1, '', 2, '', '2021-03-20', 0),
(5, 'Apakah anda dapat memilih hasil pemodelan yang mendukung kemampuan metodologi sesuai\r\nspesifikasi?', 1, '', 1, '', 3, 'Menerapkan hasil pemodelan ke dalam pengembangan program', '2021-03-20', 0),
(6, 'Apakah anda dapat memilih Hasil pemrograman (Integrated Development Environment-IDE) yang\r\nmendukung kemampuan metodologi bahasa pemrograman sesuai spesifikasi?', 1, '', 1, '', 3, '', '2021-03-20', 0),
(7, 'Apakah anda dapat menuliskan kode sumber mengikuti coding-guidelines dan best practice?', 1, '', 2, 'Menulis kode dengan prinsip sesuai guidelines dan best practices.', 4, 'Menerapkan coding-guidelines dan best practices dalam penulisan program (kode sumber)', '2021-03-20', 0),
(8, 'Apakah anda dapat membuat Struktur program yang sesuai dengan konsep paradigmanya?', 1, '', 2, '', 4, '', '2021-03-20', 0),
(9, 'Apakah anda dapat menangani galat/error?', 1, '', 2, '', 4, '', '2021-03-20', 0),
(10, 'Apakah anda dapat menghitung Efisiensi penggunaan resources oleh kode?', 1, '', 2, '', 5, 'Menggunakan ukuran performansi dalam menuliskan kode sumber', '2021-03-20', 0),
(11, 'Apakah anda dapat mengimplementasikan kemudahan interaksi selalu sesuai standar yang berlaku?', 1, '', 2, '', 5, '', '2021-03-20', 0),
(12, 'Apakah anda dapat menentukan tipe data yang sesuai standar ?', 1, '', 3, 'Mengimplementasikan pemrograman terstruktur.', 6, 'Menggunakan tipe data dan control program', '2021-03-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('super_admin','administrator','asesi','asesor') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `block_status` int(3) NOT NULL,
  `online_status` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `time_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_offline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `password`, `email`, `phone_number`, `address`, `gender`, `locale`, `picture`, `link`, `role`, `created`, `modified`, `block_status`, `online_status`, `time_online`, `time_offline`) VALUES
(3, 'google', '101206663356195272649', 'Fitra', 'Official', '06719b92a71ed5e601ca66a1f1984fec', 'fitraarrafiq@gmail.com', '082390091029', 'Jl.Telagasari, No.7, Rumbai, Pekanbaru', 'male', 'en', 'https://lh3.googleusercontent.com/a-/AOh14GhtwhoXNTWELQN3AcrTsI3YrQrhwDjkG_8qXm8Q4g=s96-c', '', 'administrator', '2020-12-27 23:22:45', '2021-03-23 06:25:12', 0, 'online', '2021-03-22 23:25:12', '2021-03-22 23:25:12'),
(5, 'google', '118271379863730119319', 'Amalya', 'Amalya', '06719b92a71ed5e601ca66a1f1984fec', 'amalya@alumni.pcr.ac.id', '08233222222', 'Jl.Medan, Kabupaten Pekanbaru, Riau', 'female', 'en', 'https://lh3.googleusercontent.com/a-/AOh14GgGRohoWi5lUnWgHPcf7m2UK6nX3tg3C6Pkoaob=s96-c', 'https://plus.google.com/118271379863730119319', 'asesor', '2021-01-07 06:08:00', '2021-03-22 19:56:56', 0, 'offline', '2021-03-22 12:57:44', '2021-03-22 12:57:44'),
(6, '', '', 'Satria', 'Dharma', '235e8cbdc61f694d398a9e54a1b8e438', 'satria@gmail.com', '081371833321', 'Jl. Barau-Barau', 'male', NULL, NULL, '', 'super_admin', '2021-01-17 05:52:54', '0000-00-00 00:00:00', 0, 'offline', '2021-03-22 13:11:51', '2021-03-22 13:11:51'),
(7, 'google', '113891723077376468955', 'Fitra', 'Arrafiq', '06719b92a71ed5e601ca66a1f1984fec', 'fitra_arrafiq@alumni.pcr.ac.id', '082390091029', 'Jl.Telagasari', 'male', 'en', 'https://lh3.googleusercontent.com/a-/AOh14GiyTBLsLFwu0z7LxKxF3KT42tAP1KFQcfv67VCcGw=s96-c', 'https://plus.google.com/113891723077376468955', 'asesi', '2021-01-25 04:19:24', '2021-03-22 17:21:34', 0, 'offline', '2021-03-22 10:22:01', '2021-03-22 10:22:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_notif`
--
ALTER TABLE `b_notif`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `b_user_log`
--
ALTER TABLE `b_user_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tb_apl_02`
--
ALTER TABLE `tb_apl_02`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_apl_02_finish`
--
ALTER TABLE `tb_apl_02_finish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_asesor`
--
ALTER TABLE `tb_asesor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_contact_us`
--
ALTER TABLE `tb_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_admin`
--
ALTER TABLE `tb_data_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_diri`
--
ALTER TABLE `tb_data_diri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pemberitahuan`
--
ALTER TABLE `tb_pemberitahuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pilihan_skema`
--
ALTER TABLE `tb_pilihan_skema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_skema`
--
ALTER TABLE `tb_skema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tentang`
--
ALTER TABLE `tb_tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_unit_elemen`
--
ALTER TABLE `tb_unit_elemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_unit_kompetensi`
--
ALTER TABLE `tb_unit_kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_unit_pertanyaan_elemen`
--
ALTER TABLE `tb_unit_pertanyaan_elemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_notif`
--
ALTER TABLE `b_notif`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `b_user_log`
--
ALTER TABLE `b_user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tb_apl_02`
--
ALTER TABLE `tb_apl_02`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_apl_02_finish`
--
ALTER TABLE `tb_apl_02_finish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_asesor`
--
ALTER TABLE `tb_asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_contact_us`
--
ALTER TABLE `tb_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_data_admin`
--
ALTER TABLE `tb_data_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_data_diri`
--
ALTER TABLE `tb_data_diri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pemberitahuan`
--
ALTER TABLE `tb_pemberitahuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pilihan_skema`
--
ALTER TABLE `tb_pilihan_skema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_skema`
--
ALTER TABLE `tb_skema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_tentang`
--
ALTER TABLE `tb_tentang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_unit_elemen`
--
ALTER TABLE `tb_unit_elemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_unit_kompetensi`
--
ALTER TABLE `tb_unit_kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_unit_pertanyaan_elemen`
--
ALTER TABLE `tb_unit_pertanyaan_elemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
