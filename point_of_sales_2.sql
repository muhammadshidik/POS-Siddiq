-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2025 pada 18.56
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
-- Database: `point_of_sales_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', '2025-06-16 02:57:13', '2025-06-21 14:28:17'),
(2, 'Makanan', '2025-06-16 02:57:22', '2025-06-21 14:28:11'),
(3, 'Cemilan', '2025-06-21 14:27:50', NULL),
(4, 'Tambah Toping', '2025-06-21 14:28:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(5) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `urutan` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `icon`, `url`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'fas fa-home', 'home.php', 1, '2025-06-11 04:21:50', '2025-06-20 15:21:43'),
(2, 0, 'Master Data', 'fa-solid fa-database', '', 2, '2025-06-11 04:28:32', '2025-06-20 15:34:41'),
(3, 0, 'Transaction', 'fa-solid fa-money-bill', '', 0, '2025-06-11 04:29:57', '2025-06-20 15:25:22'),
(4, 2, 'Product', 'fa-brands fa-product-hunt', 'product', 1, '2025-06-11 04:31:01', '2025-06-20 15:33:19'),
(6, 2, 'Menu', 'fa-solid fa-bars', 'menu', 3, '2025-06-11 04:32:23', '2025-06-20 15:38:45'),
(7, 2, 'Role', 'fa-solid fa-users', 'role', 1, '2025-06-11 04:32:43', '2025-06-20 15:37:15'),
(8, 3, 'Point Of Sale', 'fa-solid fa-pen-to-square', 'pos', 3, '2025-06-18 02:25:05', '2025-06-20 15:40:19'),
(10, 2, 'categori', 'fa-solid fa-user', 'categories', 2, '2025-06-21 14:26:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_roles`
--

CREATE TABLE `menu_roles` (
  `id` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_roles`
--

INSERT INTO `menu_roles` (`id`, `id_roles`, `id_menu`, `created_at`, `updated_at`) VALUES
(27, 4, 1, '2025-06-12 06:33:55', NULL),
(28, 4, 9, '2025-06-12 06:33:55', NULL),
(46, 9, 1, '2025-06-12 07:25:20', NULL),
(47, 9, 2, '2025-06-12 07:25:20', NULL),
(48, 9, 4, '2025-06-12 07:25:20', NULL),
(49, 9, 5, '2025-06-12 07:25:20', NULL),
(50, 9, 6, '2025-06-12 07:25:20', NULL),
(51, 9, 7, '2025-06-12 07:25:20', NULL),
(52, 9, 9, '2025-06-12 07:25:20', NULL),
(53, 9, 3, '2025-06-12 07:25:20', NULL),
(54, 6, 1, '2025-06-12 07:25:41', NULL),
(55, 6, 3, '2025-06-12 07:25:41', NULL),
(174, 1, 3, '2025-06-21 14:27:10', NULL),
(175, 1, 8, '2025-06-21 14:27:11', NULL),
(176, 1, 1, '2025-06-21 14:27:11', NULL),
(177, 1, 2, '2025-06-21 14:27:11', NULL),
(178, 1, 4, '2025-06-21 14:27:11', NULL),
(179, 1, 7, '2025-06-21 14:27:11', NULL),
(180, 1, 10, '2025-06-21 14:27:11', NULL),
(181, 1, 6, '2025-06-21 14:27:11', NULL),
(182, 3, 2, '2025-06-21 16:37:31', NULL),
(183, 3, 4, '2025-06-21 16:37:31', NULL),
(184, 3, 7, '2025-06-21 16:37:31', NULL),
(185, 3, 10, '2025-06-21 16:37:31', NULL),
(186, 3, 6, '2025-06-21 16:37:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `price` double(10,2) NOT NULL,
  `qty` int(5) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `price`, `qty`, `description`, `created_at`, `updated_at`) VALUES
(6, 0, 'Teh Tawar Panas', 2000.00, 1, '', '2025-06-21 14:28:56', NULL),
(7, 0, 'Teh Tawar Es', 3000.00, 1, '', '2025-06-21 14:29:18', NULL),
(8, 0, 'Teh Manis Panas / Es', 5000.00, 1, '', '2025-06-21 14:32:02', NULL),
(9, 0, 'Es Susu', 7000.00, 1, '', '2025-06-21 14:32:43', NULL),
(10, 0, 'Teh Susu Panas / Es', 7000.00, 1, '', '2025-06-21 14:33:21', NULL),
(11, 0, 'Milo Panas / Es', 8000.00, 1, '', '2025-06-21 16:19:04', NULL),
(12, 0, 'Extra Joss Es', 5000.00, 1, '', '2025-06-21 16:19:31', NULL),
(13, 0, 'Extra Joss Es + Susu', 8000.00, 1, '', '2025-06-21 16:20:02', NULL),
(14, 0, 'Teh Tarik', 8000.00, 1, '', '2025-06-21 16:20:21', NULL),
(15, 0, 'Chocolatos Coklat / Matcha', 8000.00, 1, '', '2025-06-21 16:21:01', NULL),
(16, 0, 'Lemon Tea Es', 6000.00, 1, '', '2025-06-21 16:21:42', NULL),
(17, 0, 'Nutrisari Es ', 6000.00, 1, '', '2025-06-21 16:22:26', NULL),
(18, 0, 'Nutrisari Susu Es ', 9000.00, 1, '', '2025-06-21 16:23:40', NULL),
(19, 0, 'Luwak White Coffee Panas', 5000.00, 1, '', '2025-06-21 16:24:20', NULL),
(20, 0, 'Luwak White Coffee Es', 6000.00, 1, '', '2025-06-21 16:24:58', NULL),
(21, 0, 'Indocafe Coffemix Panas', 5000.00, 1, '', '2025-06-21 16:25:19', NULL),
(22, 0, 'Kapal Api Special', 4000.00, 1, '', '2025-06-21 16:25:48', NULL),
(23, 0, 'Kapal Api Special Mix', 5000.00, 1, '', '2025-06-21 16:26:25', NULL),
(24, 0, 'Indomie RebusGoreng Polos', 8000.00, 1, '', '2025-06-21 16:38:49', NULL),
(25, 0, 'Indomie Rebus / Goreng + 1 Telor', 11000.00, 1, '', '2025-06-21 16:39:24', '2025-06-21 16:40:07'),
(26, 0, 'Indomie Rebus / Goreng + 2 Telor', 14000.00, 1, '', '2025-06-21 16:39:58', NULL),
(27, 0, 'Indomie Rebus / Goreng keju', 11000.00, 1, '', '2025-06-21 16:40:36', NULL),
(28, 0, 'Indomie Rebus / Goreng Telor Keju', 14000.00, 1, '', '2025-06-21 16:41:04', NULL),
(29, 0, 'Indomie Rebus / Goreng Telor Kornet', 15000.00, 1, '', '2025-06-21 16:41:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '2025-06-16 02:33:57', NULL),
(2, 'pimpinan', '2025-06-16 02:34:05', NULL),
(3, 'kasir', '2025-06-16 02:34:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_transaction` varchar(30) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `id_user`, `no_transaction`, `sub_total`, `created_at`, `update_at`) VALUES
(57, 1, 'TR-210625-001', 10000.00, '2025-06-21 16:32:53', NULL),
(58, 1, 'TR-210625-058', 16000.00, '2025-06-21 16:36:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `id_transaction`, `id_product`, `qty`, `total`, `created_at`, `update_at`) VALUES
(2, 57, 0, 2, 10000.00, '2025-06-21 16:32:54', NULL),
(3, 58, 0, 2, 4000.00, '2025-06-21 16:36:47', NULL),
(4, 58, 0, 2, 12000.00, '2025-06-21 16:36:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `update_at`) VALUES
(1, 'siddiq', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-06-16 02:10:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `id_user`, `id_role`, `created_at`, `updated_at`) VALUES
(152, 1, 3, '2025-06-16 08:17:15', NULL),
(153, 1, 1, '2025-06-16 08:17:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transact_to_transactions` (`id_transaction`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `id_transact_to_transactions` FOREIGN KEY (`id_transaction`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
