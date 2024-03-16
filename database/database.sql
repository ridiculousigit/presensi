-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2024 pada 08.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `id_materi` varchar(255) NOT NULL,
  `id_asisten` varchar(255) NOT NULL,
  `teaching_role` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `id_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `id_kelas`, `id_materi`, `id_asisten`, `teaching_role`, `date`, `start`, `end`, `duration`, `id_code`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2', 'Asisten Baris', '2024-03-14', '05:17:46', '14:36:28', '558', '1', '2024-03-13 15:17:46', '2024-03-14 00:36:28'),
(2, '3', '3', '1', 'Ketua', '2024-03-16', '13:57:54', '13:58:06', '0', '9', '2024-03-15 23:57:54', '2024-03-15 23:58:06'),
(3, '2', '2', '4', 'Asisten Baris', '2024-03-16', '14:08:26', '14:08:30', '0', '6', '2024-03-16 00:08:26', '2024-03-16 00:08:30'),
(4, '1', '1', '3', 'Tutor', '2024-03-16', '14:09:05', '14:09:07', '0', '5', '2024-03-16 00:09:05', '2024-03-16 00:09:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `code`
--

CREATE TABLE `code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `id_user_get` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `code`
--

INSERT INTO `code` (`id`, `code`, `id_user`, `id_user_get`, `created_at`, `updated_at`) VALUES
(1, 'h1dbhvWE', '1', '2', '2024-03-13 15:13:52', '2024-03-13 15:17:46'),
(2, 'xgGWlJFP', '1', NULL, '2024-03-13 15:16:34', '2024-03-13 15:16:34'),
(3, 'hawlVgKz', '1', NULL, '2024-03-13 15:16:35', '2024-03-13 15:16:35'),
(4, 'Sx08sP2a', '1', NULL, '2024-03-13 15:16:37', '2024-03-13 15:16:37'),
(5, 'X837x8WS', '1', '3', '2024-03-13 15:16:39', '2024-03-16 00:09:05'),
(6, 'cGNjy4KS', '1', '4', '2024-03-14 13:39:20', '2024-03-16 00:08:26'),
(7, 'nKrmIINi', '2', NULL, '2024-03-15 10:30:44', '2024-03-15 10:30:44'),
(8, 'c9Vy8JHG', '2', NULL, '2024-03-15 23:51:21', '2024-03-15 23:51:21'),
(9, 'XZ8fuImi', '3', '1', '2024-03-15 23:55:05', '2024-03-15 23:57:54'),
(10, '9szYoHuY', '3', NULL, '2024-03-15 23:55:08', '2024-03-15 23:55:08'),
(11, 'DnfsC4mO', '3', NULL, '2024-03-15 23:55:29', '2024-03-15 23:55:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `tingkat` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan`, `fakultas`, `tingkat`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 'Fakultas Teknologi Industri', '1', '1IA11', '2024-03-13 15:14:31', '2024-03-13 15:14:31'),
(2, 'Teknik Informatika', 'Fakultas Teknologi Industri', '2', '2IA03', '2024-03-13 15:14:43', '2024-03-13 15:14:43'),
(3, 'Teknik Informatika', 'Fakultas Teknologi Industri', '3', '3IA03', '2024-03-14 13:39:43', '2024-03-14 13:39:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `materi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id`, `materi`, `created_at`, `updated_at`) VALUES
(1, 'Algoritma dan Pemrograman', '2024-03-13 15:15:21', '2024-03-13 15:15:21'),
(2, 'Sistem Informasi Akuntansi & Keuangan', '2024-03-13 15:15:37', '2024-03-13 15:15:37'),
(3, 'Pengantar Kecerdasan Buatan', '2024-03-13 15:15:55', '2024-03-13 15:15:55'),
(4, 'Sistem Basis Data', '2024-03-14 13:56:30', '2024-03-14 13:56:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_asisten` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `join_date` date NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_asisten`, `name`, `join_date`, `role`, `photo`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '57419199', 'Sigit Prasetyo', '2024-03-12', 'Admin', 'FB_IMG_1672884424638.jpg', 'jsigit243@gmail.com', NULL, '$2y$10$TzX6nNv3J3Rnd7txYmaXTe27k6ko2qts8XQ.Ae/fG6UqGXqOuNcPO', NULL, '2021-05-18 09:55:43', '2024-03-11 14:53:44'),
(2, '52419697', 'Haidar Ali Syafiq', '2024-03-12', 'Staff', '1697723948887.jpeg', 'staff@gmail.com', NULL, '$2y$10$/vyMwJhfvP3QgWOGiBxpTOF02Cq7Q4nmSVWe5xETXkOzZ/eQivXMy', NULL, '2021-05-18 10:20:31', '2024-03-15 23:52:53'),
(3, '52419866', 'I Putu Cahya Adi Ganesha', '2024-03-12', 'PJ', '1570085340387.jpeg', 'pjawab@gmail.com', NULL, '$2y$10$xyfBdP7Fnz2TUW0LT64uouQLqbKScvGWMZbGgNprF2U3r.sTpg2c2', NULL, '2021-05-18 10:22:09', '2024-03-15 23:54:47'),
(4, '50419676', 'Ananda  Agta Ramadhan', '2024-03-12', 'undefined', '1705456012112.jpeg', 'asisten@gmail.com', NULL, '$2y$10$EueV9QGyAWpONISIZ9.g1O.4b8hmmjyRiRJa8XEC41UES.379j.VC', NULL, '2021-05-18 10:22:49', '2024-03-15 23:56:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `code`
--
ALTER TABLE `code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
