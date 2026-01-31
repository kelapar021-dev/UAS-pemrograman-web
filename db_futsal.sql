-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 07:30 PM
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
-- Database: `db_futsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `no` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nama_lapangan` varchar(100) DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `nama_member` varchar(100) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_pembayaran` enum('lunas','DP') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`no`, `nama_pelanggan`, `nama_lapangan`, `nama_paket`, `nama_member`, `total_harga`, `status_pembayaran`) VALUES
(1, 'Neymar', 'Futsal A', 'Paket 2 Jam - Siang Futsal', 'Bronze Member', 150000, 'lunas'),
(2, 'Messi', 'Futsal B', 'Paket 2 Jam - Malam Futsal', 'Silver Member', 250000, 'DP'),
(3, 'Ronaldo', 'Miniso A', 'Paket 2 Jam - Siang Minisoccer', 'Gold Member', 300000, 'lunas'),
(4, 'Ozil', 'Miniso B', 'Paket 2 Jam - Malam Minisoccer', 'Platinum Member', 600000, 'lunas'),
(5, 'Wirtz', 'Futsal C', 'Paket 3 Jam - Siang Futsal', 'Elite Member', 225000, 'DP'),
(6, 'Pedri', 'Futsal D', 'Paket 3 Jam - Malam Futsal', 'Family Silver', 375000, 'lunas'),
(7, 'Mbappe', 'Miniso C', 'Paket 3 Jam - Siang Minisoccer', 'Team Bronze 1', 450000, 'DP'),
(8, 'Yamal', 'Miniso D', 'Paket 3 Jam - Malam Minisoccer', 'Team Bronze 2', 900000, 'lunas'),
(9, 'Musiala', 'Futsal E', 'Paket Weekend 2 Jam - Futsal', 'Team Gold 1', 200000, 'lunas'),
(10, 'Sisanyan', 'Futsal F', 'Paket Weekend 2 Jam - Minisoccer', 'Family Gold', 350000, 'DP'),
(11, 'Luka', 'Futsal G', 'Paket Malam Promo Futsal 2 Jam', 'Club Platinum', 200000, 'lunas'),
(12, 'Marco', 'Futsal H', 'Paket Malam Promo Minisoccer 2 Jam', 'Regular Silver', 500000, 'DP'),
(13, 'Ansu', 'Miniso E', 'Paket Bulanan Futsal 8 Sesi', 'Regular Bronze', 1000000, 'lunas'),
(14, 'Kai', 'Miniso F', 'Paket Bulanan Minisoccer 8 Sesi', 'VIP Gold', 2000000, 'DP'),
(15, 'Riyad', 'Futsal A', 'Paket Antar Sesi 1 Jam', 'VIP Platinum', 80000, 'lunas'),
(16, 'Neymar', 'Futsal B', 'Paket 2 Jam - Siang Futsal', 'Bronze Member', 150000, 'DP'),
(17, 'Messi', 'Futsal C', 'Paket 2 Jam - Malam Futsal', 'Silver Member', 250000, 'lunas'),
(18, 'Ronaldo', 'Miniso A', 'Paket 2 Jam - Siang Minisoccer', 'Gold Member', 300000, 'DP'),
(19, 'Ozil', 'Miniso B', 'Paket 2 Jam - Malam Minisoccer', 'Platinum Member', 600000, 'lunas'),
(20, 'Wirtz', 'Futsal D', 'Paket 3 Jam - Siang Futsal', 'Elite Member', 225000, 'DP'),
(21, 'Pedri', 'Futsal E', 'Paket 3 Jam - Malam Futsal', 'Family Silver', 375000, 'lunas'),
(22, 'Mbappe', 'Miniso C', 'Paket 3 Jam - Siang Minisoccer', 'Team Bronze 1', 450000, 'DP'),
(23, 'Yamal', 'Miniso D', 'Paket 3 Jam - Malam Minisoccer', 'Team Bronze 2', 900000, 'lunas'),
(24, 'Musiala', 'Futsal F', 'Paket Weekend 2 Jam - Futsal', 'Team Gold 1', 200000, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `booking_backup`
--

CREATE TABLE `booking_backup` (
  `id_booking` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nama_lapangan` varchar(100) DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `nama_member` varchar(100) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_backup`
--

INSERT INTO `booking_backup` (`id_booking`, `nama_pelanggan`, `nama_lapangan`, `nama_paket`, `nama_member`, `total_harga`, `status_pembayaran`) VALUES
(1, 'Neymar', 'Futsal A', 'Paket 2 Jam - Siang Futsal', 'Bronze Member', 150000, 'lunas'),
(2, 'Messi', 'Futsal B', 'Paket 2 Jam - Malam Futsal', 'Silver Member', 250000, 'DP'),
(3, 'Ronaldo', 'Miniso A', 'Paket 2 Jam - Siang Minisoccer', 'Gold Member', 300000, 'lunas'),
(4, 'Ozil', 'Miniso B', 'Paket 2 Jam - Malam Minisoccer', 'Platinum Member', 600000, 'lunas'),
(5, 'Wirtz', 'Futsal C', 'Paket 3 Jam - Siang Futsal', 'Elite Member', 225000, 'DP'),
(6, 'Pedri', 'Futsal D', 'Paket 3 Jam - Malam Futsal', 'Family Silver', 375000, 'lunas'),
(7, 'Mbappe', 'Miniso C', 'Paket 3 Jam - Siang Minisoccer', 'Team Bronze 1', 450000, 'DP'),
(8, 'Yamal', 'Miniso D', 'Paket 3 Jam - Malam Minisoccer', 'Team Bronze 2', 900000, 'lunas'),
(9, 'Musiala', 'Futsal E', 'Paket Weekend 2 Jam - Futsal', 'Team Gold 1', 200000, 'lunas'),
(10, 'Sisanyan', 'Futsal F', 'Paket Weekend 2 Jam - Minisoccer', 'Family Gold', 350000, 'DP'),
(11, 'Luka', 'Futsal G', 'Paket Malam Promo Futsal 2 Jam', 'Club Platinum', 200000, 'lunas'),
(12, 'Marco', 'Futsal H', 'Paket Malam Promo Minisoccer 2 Jam', 'Regular Silver', 500000, 'DP'),
(13, 'Ansu', 'Miniso E', 'Paket Bulanan Futsal 8 Sesi', 'Regular Bronze', 1000000, 'lunas'),
(14, 'Kai', 'Miniso F', 'Paket Bulanan Minisoccer 8 Sesi', 'VIP Gold', 2000000, 'DP'),
(15, 'Riyad', 'Futsal A', 'Paket Antar Sesi 1 Jam', 'VIP Platinum', 80000, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `booking_sampah`
--

CREATE TABLE `booking_sampah` (
  `id_booking` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `lapangan` varchar(50) DEFAULT NULL,
  `paket` varchar(100) DEFAULT NULL,
  `member` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `status` enum('DP','Lunas') DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `gaji` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `nama_pegawai`, `jabatan`, `tanggal`, `jam`, `gaji`) VALUES
(1, 'Ahmad Faisal', 'Manajer Lapangan', '2025-02-01', '08:00:00', 5000000),
(2, 'Siti Rahma', 'Kasir', '2025-02-01', '08:30:00', 3000000),
(3, 'Budi Santoso', 'Petugas Kebersihan', '2025-02-01', '09:00:00', 2500000),
(4, 'Rina Dewi', 'Petugas Kebersihan', '2025-02-01', '09:30:00', 2500000),
(5, 'Anton Wijaya', 'Penjaga Lapangan', '2025-02-01', '10:00:00', 2800000),
(6, 'Linda Sari', 'Customer Service', '2025-02-02', '08:30:00', 3200000),
(7, 'Dedi Permana', 'Teknisi & Pemelihara', '2025-02-02', '09:00:00', 3500000),
(8, 'Maya Putri', 'Penjadwalan & Booking', '2025-02-02', '09:30:00', 3300000),
(9, 'Joko Susilo', 'Satpam / Keamanan', '2025-02-02', '10:00:00', 3000000),
(10, 'Wulan Nur', 'Administrasi & Kasir', '2025-02-02', '10:30:00', 3100000),
(11, 'Fajar Nugroho', 'Petugas Kebersihan', '2025-02-03', '08:00:00', 2500000),
(12, 'Rina Putri', 'Staf Administrasi', '2025-02-03', '08:30:00', 3000000),
(13, 'Sandi Pratama', 'Penjaga Lapangan', '2025-02-03', '09:00:00', 2800000),
(14, 'Dewi Listiani', 'Customer Support', '2025-02-03', '09:30:00', 3200000),
(15, 'Rizky Hidayat', 'Teknisi / Maintenance', '2025-02-03', '10:00:00', 3500000),
(17, 'Siti Rahma', 'Kasir', '2025-02-04', '08:45:00', 3000000),
(18, 'Budi Santoso', 'Petugas Kebersihan', '2025-02-04', '09:15:00', 2500000),
(19, 'Rina Dewi', 'Petugas Kebersihan', '2025-02-04', '09:45:00', 2500000),
(20, 'Anton Wijaya', 'Penjaga Lapangan', '2025-02-04', '10:15:00', 2800000),
(21, 'Linda Sari', 'Customer Service', '2025-02-05', '08:30:00', 3200000),
(22, 'Dedi Permana', 'Teknisi & Pemelihara', '2025-02-05', '09:00:00', 3500000),
(23, 'Maya Putri', 'Penjadwalan & Booking', '2025-02-05', '09:30:00', 3300000),
(24, 'Joko Susilo', 'Satpam / Keamanan', '2025-02-05', '10:00:00', 3000000),
(25, 'Wulan Nur', 'Administrasi & Kasir', '2025-02-05', '10:30:00', 3100000),
(26, 'Fajar Nugroho', 'Petugas Kebersihan', '2025-02-06', '08:00:00', 2500000),
(27, 'Rina Putri', 'Staf Administrasi', '2025-02-06', '08:30:00', 3000000),
(28, 'Sandi Pratama', 'Penjaga Lapangan', '2025-02-06', '09:00:00', 2800000),
(29, 'Dewi Listiani', 'Customer Support', '2025-02-06', '09:30:00', 3200000),
(30, 'Ahmad Faisal', 'Manajer Lapangan', '2026-01-02', '12:30:00', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `gaji_pegawai`
--

CREATE TABLE `gaji_pegawai` (
  `id_gaji` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `gaji` decimal(12,2) NOT NULL,
  `bonus` decimal(12,2) DEFAULT 0.00,
  `potongan` decimal(12,2) DEFAULT 0.00,
  `total_gaji` decimal(12,2) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `status_bayar` enum('Lunas','Belum Lunas') DEFAULT 'Belum Lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('Tersedia','Terboking') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` int(11) NOT NULL,
  `nama_lapangan` varchar(100) DEFAULT NULL,
  `jenis_lapangan` varchar(50) DEFAULT NULL,
  `status_lapangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `nama_lapangan`, `jenis_lapangan`, `status_lapangan`) VALUES
(1, 'futsal a', 'futsal', 'tersedia'),
(2, 'futsal b', 'futsal', 'tersedia'),
(3, 'futsal c', 'futsal', 'tersedia'),
(4, 'futsal d', 'futsal', 'tidak tersedia'),
(5, 'futsal e', 'futsal', 'tersedia'),
(6, 'futsal f', 'futsal', 'tidak tersedia'),
(7, 'futsal g', 'futsal', 'tersedia'),
(8, 'miniso a', 'minisoccer', 'tersedia'),
(9, 'miniso b', 'minisoccer', 'tidak tersedia'),
(10, 'miniso c', 'minisoccer', 'tersedia'),
(11, 'miniso d', 'minisoccer', 'tersedia'),
(12, 'miniso e', 'minisoccer', 'tidak tersedia'),
(13, 'miniso f', 'minisoccer', 'tersedia'),
(14, 'miniso g', 'minisoccer', 'tidak tersedia'),
(15, 'miniso h', 'minisoccer', 'tersedia'),
(16, 'futsal a', 'futsal', 'tidak tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama_member` varchar(100) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `tier` varchar(50) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `nama_member`, `nama_pemilik`, `tier`, `diskon`, `tgl_daftar`) VALUES
(1, 'TEAM BRONZE 2', 'CLARA', 'BRONZE', 5, '2025-01-10'),
(2, 'TEAM GOLD 1', 'DINA', 'GOLD', 12, '2025-01-11'),
(3, 'FAMILY GOLD', 'EVA', 'GOLD', 12, '2025-01-12'),
(4, 'CLUB PLATINUM', 'NEYMAR', 'PLATINUM', 15, '2025-01-13'),
(5, 'REGULAR SILVER', 'MESSI', 'SILVER', 10, '2025-01-14'),
(6, 'REGULAR BRONZE', 'RONALDO', 'BRONZE', 5, '2025-01-15'),
(7, 'VIP GOLD', 'OZIL', 'GOLD', 20, '2025-01-16'),
(8, 'VIP PLATINUM', 'WIRTZ', 'PLATINUM', 25, '2025-01-17'),
(9, 'BRONZE MEMBER', 'PEDRI', 'BRONZE', 5, '2025-01-18'),
(10, 'SILVER MEMBER', 'MBAPPE', 'SILVER', 8, '2025-01-19'),
(11, 'GOLD MEMBER', 'YAMAL', 'GOLD', 10, '2025-01-20'),
(12, 'PLATINUM MEMBER', 'MUSIALA', 'PLATINUM', 15, '2025-01-21'),
(13, 'ELITE MEMBER', 'SISANYAN', 'ELITE', 20, '2025-01-22'),
(14, 'BRONZE MEMBER', 'KARIN', 'BRONZE', 5, '2025-01-23'),
(15, 'ELITE MEMBER', 'OCTAVIA', 'ELITE', 20, '2025-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `durasi_jam` int(11) NOT NULL,
  `harga_paket` decimal(12,2) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `durasi_jam`, `harga_paket`, `deskripsi`) VALUES
(1, 'Paket 2 Jam - Siang Futsal', 2, 150000.00, 'Paket bermain futsal 2 jam di waktu siang'),
(2, 'Paket 2 Jam - Malam Futsal', 2, 250000.00, 'Paket bermain futsal 2 jam di waktu malam'),
(3, 'Paket 3 Jam - Siang Futsal', 3, 225000.00, 'Paket bermain futsal 3 jam di waktu siang'),
(4, 'Paket 3 Jam - Malam Futsal', 3, 375000.00, 'Paket bermain futsal 3 jam di waktu malam'),
(5, 'Paket 2 Jam - Siang Minisoccer', 2, 300000.00, 'Paket bermain minisoccer 2 jam di waktu siang'),
(6, 'Paket 2 Jam - Malam Minisoccer', 2, 600000.00, 'Paket bermain minisoccer 2 jam di waktu malam'),
(7, 'Paket 3 Jam - Siang Minisoccer', 3, 450000.00, 'Paket bermain minisoccer 3 jam di waktu siang'),
(8, 'Paket 3 Jam - Malam Minisoccer', 3, 900000.00, 'Paket bermain minisoccer 3 jam di waktu malam'),
(9, 'Paket Weekend 2 Jam - Futsal', 2, 200000.00, 'Paket bermain futsal 2 jam di hari weekend'),
(10, 'Paket Weekend 2 Jam - Minisoccer', 2, 350000.00, 'Paket bermain minisoccer 2 jam di hari weekend'),
(11, 'Paket Malam Promo Futsal 2 Jam', 2, 200000.00, 'Paket promo bermain futsal 2 jam di waktu malam'),
(12, 'Paket Malam Promo Minisoccer 2 Jam', 2, 500000.00, 'Paket promo bermain minisoccer 2 jam di waktu malam'),
(13, 'Paket Bulanan Futsal 8 Sesi', 8, 1000000.00, 'Paket bulanan bermain futsal 8 sesi'),
(14, 'Paket Bulanan Minisoccer 8 Sesi', 8, 2000000.00, 'Paket bulanan bermain minisoccer 8 sesi'),
(15, 'Paket Antar Sesi 1 Jam', 1, 80000.00, 'Paket bermain antar sesi 1 jam');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gaji_pokok` decimal(12,2) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `no_hp`, `jabatan`, `gaji_pokok`, `tanggal_masuk`, `status`, `created_at`) VALUES
(1, 'Ahmad Faisal', '081234500001', 'Manajer Lapangan', 5000000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(2, 'Siti Rahma', '081234500002', 'Kasir', 3500000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(3, 'Budi Santoso', '081234500003', 'Petugas Kebersihan & Maintenance', 3000000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(4, 'Rina Dewi', '081234500004', 'Petugas Kebersihan & Maintenance', 3000000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(5, 'Anton Wijaya', '081234500005', 'Penjaga Lapangan & Pengawas', 3200000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(6, 'Linda Sari', '081234500006', 'Customer Service / Booking', 3500000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(7, 'Dedi Permana', '081234500007', 'Teknisi Lapangan', 3200000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(8, 'Maya Putri', '081234500008', 'Penjadwalan & Booking', 3500000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(9, 'Joko Susilo', '081234500009', 'Satpam / Keamanan', 3000000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(10, 'Wulan Nur', '081234500010', 'Administrasi & Kasir', 3500000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(11, 'Fajar Nugroho', '081234500011', 'Petugas Kebersihan & Maintenance', 3000000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(12, 'Rina Putri', '081234500012', 'Staf Administrasi & Akuntansi', 3800000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(13, 'Sandi Pratama', '081234500013', 'Penjaga Lapangan', 3200000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(14, 'Dewi Listiani', '081234500014', 'Customer Support / Receptionist', 3500000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(15, 'Rizky Hidayat', '081234500015', 'Teknisi / Maintenance', 3200000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(16, 'karin octavia', '083845324567', 'istri pemilik lapang', 9000000.00, '2023-01-10', 'Aktif', '2026-01-31 16:13:29'),
(17, 'karin octavia', '085321346578', 'istri pemilik lapangan', 300000000.00, '0000-00-00', 'Aktif', '2026-01-31 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `No` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `lapangan_dipesan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`No`, `nama`, `no_hp`, `lapangan_dipesan`) VALUES
(1, 'Alya', '081234560001', 'futsal b'),
(2, 'dodo', '081234560002', 'miniso a'),
(3, 'Sari', '081234560003', 'futsal c'),
(4, 'messi', '081234560004', 'miniso b'),
(5, 'abni', '081234560005', 'futsal d'),
(6, 'kipli', '081234560006', 'miniso c'),
(7, 'Dewi', '081234560007', 'futsal e'),
(8, 'lamine', '081234560008', 'miniso d'),
(9, 'Rini', '081234560009', 'futsal f'),
(10, 'neymar', '081234560010', 'miniso e'),
(11, 'Ratna', '081234560011', 'futsal g'),
(12, 'wirtz', '081234560012', 'miniso f'),
(13, 'Sinta', '081234560013', 'futsal a'),
(14, 'pedri', '081234560014', 'miniso g'),
(15, 'Tina', '081234560015', 'futsal b'),
(16, 'octavia', '085355678894', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT current_timestamp(),
  `metode_bayar` varchar(50) DEFAULT NULL,
  `nama_kasir` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `tgl_bayar`, `metode_bayar`, `nama_kasir`) VALUES
(1, 1, '2026-01-31 22:40:35', 'Cash', 'Admin_Siti'),
(2, 2, '2026-01-31 22:40:35', 'Transfer', 'Admin_Budi'),
(3, 3, '2026-01-31 22:40:35', 'QRIS', 'Admin_Siti');

-- --------------------------------------------------------

--
-- Table structure for table `peralatan`
--

CREATE TABLE `peralatan` (
  `id_peralatan` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `jenis_alat` varchar(50) NOT NULL,
  `stok_tersedia` int(11) NOT NULL DEFAULT 0,
  `harga_sewa_per_hari` decimal(12,2) NOT NULL,
  `kondisi` enum('Baik','Rusak','Maintenance') DEFAULT 'Baik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peralatan`
--

INSERT INTO `peralatan` (`id_peralatan`, `nama_alat`, `jenis_alat`, `stok_tersedia`, `harga_sewa_per_hari`, `kondisi`) VALUES
(1, 'bola futsal', 'olahraga', 10, 5000.00, 'Baik'),
(2, 'sarung tangan kiper', 'olahraga', 8, 10000.00, 'Baik'),
(3, 'rompi biru', 'olahraga', 15, 3000.00, 'Baik'),
(4, 'rompi putih', 'olahraga', 15, 3000.00, ''),
(5, 'pel', 'kebersihan', 6, 5000.00, 'Rusak'),
(6, 'konus latihan', 'olahraga', 20, 2000.00, 'Baik'),
(7, 'bola minisoccer', 'olahraga', 8, 8000.00, ''),
(8, 'pelindung kaki', 'olahraga', 6, 15000.00, 'Baik'),
(9, 'pompa', 'alat', 4, 3000.00, ''),
(10, 'baju wasit', 'pakaian', 12, 7000.00, 'Baik'),
(11, 'peluit wasit', 'alat', 2, 5000.00, ''),
(12, 'timer pertandingan', 'elektronik', 1, 20000.00, 'Baik'),
(13, 'tandu cedera', 'medis', 1, 50000.00, ''),
(14, 'pentil bola', 'alat', 30, 1000.00, 'Baik'),
(15, 'kotak P3K', 'medis', 1, 10000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_alat`
--

CREATE TABLE `sewa_alat` (
  `id` int(11) NOT NULL,
  `nama_penyewa` varchar(100) DEFAULT NULL,
  `nama_peralatan` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sewa_alat`
--

INSERT INTO `sewa_alat` (`id`, `nama_penyewa`, `nama_peralatan`, `jumlah`, `tanggal`, `jam`, `total_bayar`) VALUES
(1, 'Andi', 'Bola Futsal', 1, '2025-01-20', '10:30:00', 25000),
(2, 'Budi', 'Sepatu Futsal', 1, '2025-01-20', '11:00:00', 75000),
(3, 'Citra', 'Kapu Futsal', 2, '2025-01-21', '14:15:00', 50000),
(4, 'Penyewa1', 'Bola', 2, '2025-01-01', '08:00:00', 50000),
(5, 'Penyewa2', 'Pompa', 1, '2025-01-01', '09:00:00', 20000),
(6, 'Penyewa3', 'Bola', 3, '2025-01-01', '10:00:00', 75000),
(7, 'Penyewa4', 'Pompa', 1, '2025-01-01', '11:00:00', 20000),
(8, 'Penyewa5', 'Bola', 2, '2025-01-01', '12:00:00', 50000),
(9, 'Penyewa6', 'Pompa', 2, '2025-01-01', '13:00:00', 40000),
(10, 'Penyewa7', 'Bola', 1, '2025-01-01', '14:00:00', 25000),
(11, 'Penyewa8', 'Pompa', 1, '2025-01-01', '15:00:00', 20000),
(12, 'Penyewa9', 'Bola', 3, '2025-01-01', '16:00:00', 75000),
(13, 'Penyewa10', 'Pompa', 1, '2025-01-01', '17:00:00', 20000),
(14, 'Penyewa11', 'Bola', 2, '2025-01-05', '16:00:00', 50000),
(15, 'Penyewa12', 'Pompa', 1, '2025-01-05', '17:00:00', 20000),
(16, 'Penyewa13', 'Cone', 5, '2025-01-02', '08:00:00', 25000),
(17, 'Penyewa14', 'Rompi', 4, '2025-01-02', '09:00:00', 40000),
(18, 'Penyewa15', 'Sepatu Futsal', 3, '2025-01-02', '10:00:00', 150000),
(19, 'Penyewa16', 'Jaring Gawang', 1, '2025-01-02', '11:00:00', 30000),
(20, 'Penyewa17', 'Bola', 2, '2025-01-02', '12:00:00', 50000),
(21, 'Penyewa18', 'Pompa', 2, '2025-01-02', '13:00:00', 40000),
(22, 'Penyewa19', 'Cone', 6, '2025-01-02', '14:00:00', 30000),
(23, 'Penyewa20', 'Rompi', 2, '2025-01-02', '15:00:00', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `sewa_peralatan`
--

CREATE TABLE `sewa_peralatan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nama_alat` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `nama_tarif` varchar(100) NOT NULL,
  `jenis_hari` enum('Weekday','Weekend') NOT NULL,
  `harga_per_jam` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `nama_tarif`, `jenis_hari`, `harga_per_jam`) VALUES
(3, 'miniso siang', 'Weekday', 300000.00),
(4, 'miniso malam', 'Weekday', 600000.00),
(5, 'futsal weekend siang', 'Weekend', 175000.00),
(6, 'futsal weekend malam', 'Weekend', 275000.00),
(7, 'miniso weekend siang', 'Weekend', 320000.00),
(8, 'miniso weekend malam', 'Weekend', 650000.00),
(9, 'futsal midweek siang', 'Weekday', 140000.00),
(10, 'futsal midweek malam', 'Weekday', 240000.00),
(11, 'miniso midweek siang', 'Weekday', 290000.00),
(12, 'miniso midweek malam', 'Weekday', 580000.00),
(13, 'futsal promo siang', '', 120000.00),
(14, 'miniso promo siang', '', 250000.00),
(15, 'miniso promo malam', '', 500000.00),
(16, 'Futsal Siang', 'Weekday', 200000.00),
(17, 'futsal malam', 'Weekday', 250000.00),
(18, 'futsal sore', 'Weekday', 200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id_transaksi` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `total_bayar` decimal(12,2) NOT NULL,
  `metode_bayar` enum('Tunai','Transfer','Kartu Kredit','E-Wallet') NOT NULL,
  `status_bayar` enum('Lunas','Belum Lunas','DP') DEFAULT 'Belum Lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$8S8lI8L/S.uO1GzPjYyTKuQ5eF7iV2kM9t/rG5b6G/6q7F8G9H0I1', 'Administrator'),
(2, 'karin', '$2y$10$A4qZVAfH..zszQ.ZRH9Z/OutnA0HpWSn5xFWuxqgZMWxCpfhU73ea', 'karin putri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `booking_backup`
--
ALTER TABLE `booking_backup`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `booking_sampah`
--
ALTER TABLE `booking_sampah`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji_pegawai`
--
ALTER TABLE `gaji_pegawai`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `peralatan`
--
ALTER TABLE `peralatan`
  ADD PRIMARY KEY (`id_peralatan`);

--
-- Indexes for table `sewa_alat`
--
ALTER TABLE `sewa_alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewa_peralatan`
--
ALTER TABLE `sewa_peralatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `booking_backup`
--
ALTER TABLE `booking_backup`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `booking_sampah`
--
ALTER TABLE `booking_sampah`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `gaji_pegawai`
--
ALTER TABLE `gaji_pegawai`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peralatan`
--
ALTER TABLE `peralatan`
  MODIFY `id_peralatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sewa_alat`
--
ALTER TABLE `sewa_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sewa_peralatan`
--
ALTER TABLE `sewa_peralatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_sampah`
--
ALTER TABLE `booking_sampah`
  ADD CONSTRAINT `booking_sampah_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`No`);

--
-- Constraints for table `gaji_pegawai`
--
ALTER TABLE `gaji_pegawai`
  ADD CONSTRAINT `gaji_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
