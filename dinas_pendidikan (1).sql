-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Sep 2026 pada 06.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinas_pendidikan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `waktu` time NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `pejabat_narasumber` varchar(255) DEFAULT NULL,
  `peserta` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `user_id`, `tanggal`, `tanggal_selesai`, `waktu`, `nama_kegiatan`, `tempat`, `pejabat_narasumber`, `peserta`, `deskripsi`, `keterangan`) VALUES
(2, NULL, '2026-09-23', NULL, '15:48:00', 'bbb', 'vv', NULL, NULL, NULL, 'vv'),
(3, NULL, '2026-09-23', NULL, '10:51:00', 'yy', 'bbzzz', NULL, NULL, NULL, 'xxx'),
(4, NULL, '2026-09-23', NULL, '13:52:00', 'zzzzz', 'zzzzzzzzz', NULL, NULL, NULL, 'zzzzzz'),
(5, NULL, '2026-09-23', NULL, '14:11:00', 'yyyyyyyzzzzz', 'zzzzzzza', NULL, NULL, NULL, NULL),
(6, NULL, '2026-09-27', '2026-09-30', '13:45:00', 'konsultasi', 'UNESA', 'rr', '23', 'zzz', NULL),
(7, NULL, '2026-10-30', NULL, '09:49:00', 'bimbingan', 'Universitas Negeri Surabaya', 'vv', '30', 'zzzzz', NULL),
(8, NULL, '2026-09-28', '2026-09-30', '10:14:00', 'zz', 'zz', 'zz', '11', 'zz', NULL),
(9, NULL, '2026-09-28', NULL, '10:20:00', 'z', 'z', 'z', '11', 'z', NULL),
(10, NULL, '2026-10-23', NULL, '14:12:00', 'vvvvvv', 'vvvvvvv', 'vvvvvvvvv', '33', 'vvvvvvvvvv', NULL),
(11, 7, '2026-09-26', NULL, '19:28:00', 'yy', 'UNAIR', 'revita', '31', 'hmm', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda_dokumentasi`
--

CREATE TABLE `agenda_dokumentasi` (
  `id` int(11) UNSIGNED NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `agenda_dokumentasi`
--

INSERT INTO `agenda_dokumentasi` (`id`, `agenda_id`, `nama_file`, `created_at`) VALUES
(1, 8, '1790565440_71c43bbfb8ea9a324f42.png', '2026-09-28 10:17:20'),
(2, 9, '1790565490_3f5fa4b30f5cfae177ff.png', '2026-09-28 10:18:10'),
(3, 7, '1790572176_bf5c6ac1f86d0f9d10d2.png', '2026-09-28 12:09:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-09-30-000001', 'App\\Database\\Migrations\\AddPasswordResetSupport', 'default', 'App', 1790738448, 1),
(2, '2026-09-30-000002', 'App\\Database\\Migrations\\CreatePasswordResetRequests', 'default', 'App', 1790741162, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_requests`
--

CREATE TABLE `password_reset_requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `requested_at` datetime NOT NULL,
  `resolved_by` int(11) UNSIGNED DEFAULT NULL,
  `resolved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `password_reset_requests`
--

INSERT INTO `password_reset_requests` (`id`, `user_id`, `status`, `requested_at`, `resolved_by`, `resolved_at`) VALUES
(2, 8, 'pending', '2026-09-30 04:09:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Admin',
  `status` varchar(20) NOT NULL DEFAULT 'Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Revita Dwi Amanda', 'amanda', '$2y$12$.OCJcSt4bgY.gxxkpIYKn.cJCVVu.RLKWAi1.RFzTrNhJrHYOM3S', 'Admin', 'Aktif', '2026-09-24 05:41:45', '2026-09-24 05:41:45'),
(5, 'finaya rokayah', 'rokayah', '$2y$10$2wTNKE..zIM75vBs2orE1uNBZZaB3r.74JngXbmPeqbEIHZ4W.gUe', 'Admin', 'Aktif', '2026-09-24 06:00:09', '2026-09-24 06:00:09'),
(6, 'royco', 'vvv', '$2y$10$Ue/j7VIDn1li8JyEAQTeXuKSicV27jUxlSv0eUhmWhsJDltaGV2Xq', 'Admin', 'Aktif', '2026-09-24 06:15:44', '2026-09-24 06:15:44'),
(7, 'ggg', 'ggg', '$2y$10$I8B7updjONTi.srLRzQoj.hD8NK2dOxKakegY/ebV8knMNyaQbRX6', 'Karyawan Dindik', 'Aktif', '2026-09-24 06:24:09', '2026-09-24 06:24:09'),
(8, 'RV', 'rv', '$2y$10$eOqNAinl2qk.VNaW7kp5yOir8Wyts5LdfcmWTtfgJ5F9eAjhj6xsq', 'Admin', 'Aktif', '2026-09-30 10:06:59', '2026-09-30 04:27:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `agenda_dokumentasi`
--
ALTER TABLE `agenda_dokumentasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_agenda_id` (`agenda_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_requests`
--
ALTER TABLE `password_reset_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_status` (`user_id`,`status`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `agenda_dokumentasi`
--
ALTER TABLE `agenda_dokumentasi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `password_reset_requests`
--
ALTER TABLE `password_reset_requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
