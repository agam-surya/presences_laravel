-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2022 pada 02.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presences_laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time DEFAULT NULL,
  `limit_start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `limit_end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `attendances`
--

INSERT INTO `attendances` (`id`, `position_id`, `title`, `start_time`, `limit_start_time`, `end_time`, `limit_end_time`, `created_at`, `updated_at`) VALUES
(1, 2, 'jam masuk pegawai', '07:00:00', '07:10:00', '16:00:00', '16:10:00', '2022-11-02 10:12:58', '2022-11-11 23:52:42'),
(2, 1, 'jam masuk Dosen', NULL, NULL, NULL, NULL, '2022-11-02 10:12:58', '2022-11-03 03:54:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_11_110820_create_positions_table', 1),
(6, '2022_09_28_102205_create_roles_table', 1),
(7, '2022_09_28_142245_create_presences_table', 1),
(8, '2022_09_28_142526_create_permissions_table', 1),
(9, '2022_09_28_142548_create_permission_types_table', 1),
(10, '2022_09_28_150515_create_attendances_table', 1),
(11, '2022_09_28_161136_add_column_in_users_table', 1),
(12, '2022_09_28_223453_add_column_in_permissions_table', 1),
(13, '2022_09_28_224422_add_column_in_presences_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `desciption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sart_izin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_end_izin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `permission_type_id`, `user_id`, `desciption`, `tanggal_sart_izin`, `tanggal_end_izin`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 'izin cuti', '22-11-03', '22-05-01', 'post-file/OFDnCGSWiTlvjpqAUjTVBstJfRJVKLUnjxojjL56.pdf', '2022-11-03 07:02:13', '2022-11-03 07:02:13'),
(2, 1, 6, 'izin cuti', '22-11-03', '22-05-01', 'post-file/wpBuW91ikptVWHddo1x4N2WGrW7bQRGk5bj5z6nn.pdf', '2022-11-03 07:16:20', '2022-11-03 07:16:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_types`
--

CREATE TABLE `permission_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_types`
--

INSERT INTO `permission_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'wfh', '2022-11-02 10:12:58', '2022-11-02 10:12:58'),
(2, 'wfo', '2022-11-02 10:12:58', '2022-11-02 10:12:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'token-auth', '309ced2fc16102c42f33e48ce12f66561bd4d0d1efe8fa2124caf5333e7525aa', '[\"*\"]', '2022-11-02 10:26:14', '2022-11-02 10:25:45', '2022-11-02 10:26:14'),
(2, 'App\\Models\\User', 6, 'token-auth', '46901e1232ef25ba5c4c9066c65ca9b55c3e6fc8d4ff1c84e30e0414cb7b8a66', '[\"*\"]', '2022-11-03 07:16:20', '2022-11-03 07:00:30', '2022-11-03 07:16:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`id`, `posisi`, `created_at`, `updated_at`) VALUES
(1, 'dosen', '2022-11-02 10:12:58', '2022-11-02 10:12:58'),
(2, 'pegawai', '2022-11-02 10:12:58', '2022-11-02 10:12:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presences`
--

CREATE TABLE `presences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` bigint(20) UNSIGNED NOT NULL,
  `presence_date` date NOT NULL,
  `presence_enter_time` time DEFAULT NULL,
  `latitude` decimal(12,5) DEFAULT NULL,
  `longitude` decimal(12,5) DEFAULT NULL,
  `presence_out_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `presences`
--

INSERT INTO `presences` (`id`, `user_id`, `attendance_id`, `presence_date`, `presence_enter_time`, `latitude`, `longitude`, `presence_out_time`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2022-11-02', NULL, '12.00000', '1.00000', NULL, '2022-11-02 10:26:14', '2022-11-02 10:26:14'),
(2, 1, 1, '2022-11-02', NULL, NULL, NULL, NULL, '2022-11-02 10:26:14', '2022-11-02 10:26:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-11-02 10:12:57', '2022-11-02 10:12:57'),
(2, 'user', '2022-11-02 10:12:58', '2022-11-02 10:12:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `role_id`, `position_id`, `phone`, `name`, `image`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'pegawai3@gmail.com', '2022-11-02 10:56:07', '$2y$10$3n96DH.ZyTRZNmtdKoPJZeaZOFQJfULYgLCxXMFBeXYxdvgR/mmP.', 2, 2, '081081081', 'pegawai67', 'post-image/A4jHUAiO4BnRCOmXhOxjiG6UEddtzNbBMqgwLTth.png', 'address', 'rLCf0eqMfS3YsoFwek6txy3mZs0JCuo1gHJ1IjPWF9dWjbmU8qxBQh9wC8cx', '2022-11-02 10:56:07', '2022-11-12 13:48:21'),
(5, 'pegawai2@gmail.com', NULL, '$2y$10$/pktZo1GvlHefKy49hH5HOQplwgcHAl2NdmJW7yZ0f1GTaGM..ovS', 1, 2, '09876544321', 'soleh k', 'post-image/WmylVi6To1AVRynXPRjnssVHYCkbO6npcSEqbwUU.jpg', 'asdasda', NULL, '2022-11-03 03:48:06', '2022-11-08 04:25:14'),
(6, 'pegawai1@gmail.com', NULL, '$2y$10$ilf55YIh6QG96fqldib5pe4Z7yfTIze8nY8aqxdP6thswGXwU3DmS', 2, 2, '0987654321', 'pegawai1', 'post-image/e1RSW4JGvS3EzMza3RZEzan9v4B2gTwG6j5ki7om.jpg', 'jalan pegawai 1, banyuwangi', NULL, '2022-11-03 03:49:09', '2022-11-06 04:00:27'),
(10, 'fatis@gmial.com', NULL, '$2y$10$jeR8pnCThU2wE37xLq3dYudQk3xpTNseHNmKMYRu12T0fRqEkj/HG', 1, 2, '123456789', 'takim', 'post-image/2zgi52faWsr2qdQxj39ExWWIqK9sJaNyMvKtsQZd.png', 'address', NULL, '2022-11-11 22:35:13', '2022-11-11 22:35:13'),
(22, 'susaha@gmail.com', NULL, '$2y$10$tAAWYcvIP0T48uzEJouUN.qELc/5XYpNVAS7F1.MADbBxsjAFEuJK', 1, 2, '0987654', 'susah', 'post-image/4piCTPfHmefwP6Xbnzw0L0ngDw3zAtnW1OzBEmCd.png', 'adasd', NULL, '2022-11-12 15:48:40', '2022-11-13 05:19:18'),
(23, 'dosena@gmail.com', NULL, '$2y$10$3hhlc/fRXdBBpeAjm0BMyuSm6eqkKc5a.p2atE99tnd405cf6QfEm', 2, 1, '123345678', 'dosen a', 'post-image/bd8UcSOjqtCIDt7VOPh8XPNgNLifswovGTPUWkHA.png', 'banyuwangi', NULL, '2022-11-13 05:17:11', '2022-11-13 05:17:11'),
(24, 'dosenb@gmail.com', NULL, '$2y$10$hu8x01ZzaOfujKkQkxIPROrChWdrYk2Rme9LNU4Uo7B1m0jehC6wO', 2, 1, '098765421', 'dosen b', 'post-image/2V7dMmCmieINsS2qvTWVkpEn5E6bNRwrr4JXEAqj.png', 'banyuwangi', NULL, '2022-11-13 05:17:45', '2022-11-13 05:17:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_position_id_foreign` (`position_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_permission_type_id_foreign` (`permission_type_id`),
  ADD KEY `permissions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `permission_types`
--
ALTER TABLE `permission_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presences_user_id_foreign` (`user_id`),
  ADD KEY `presences_attendance_id_foreign` (`attendance_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `permission_types`
--
ALTER TABLE `permission_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `presences`
--
ALTER TABLE `presences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Ketidakleluasaan untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_permission_type_id_foreign` FOREIGN KEY (`permission_type_id`) REFERENCES `permission_types` (`id`),
  ADD CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `attendances` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
