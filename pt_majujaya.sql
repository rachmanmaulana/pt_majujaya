-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2026 pada 03.21
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pt_majujaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'Toko Elektronik Maju', 'Jl. Sudirman No. 10, Jakarta', '021-5551234', '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(2, 'CV Berkah Elektronik', 'Jl. Gatot Subroto No. 25, Bandung', '022-7778888', '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(3, 'UD Sejahtera', 'Jl. Pemuda No. 5, Surabaya', '031-9991111', '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(4, 'Toko Listrik Jaya', 'Jl. Diponegoro No. 15, Semarang', '024-4445555', '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(5, 'PT Global Elektronik', 'Jl. Ahmad Yani No. 88, Yogyakarta', '0274-333222', '2026-05-28 13:20:25', '2026-05-28 13:20:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `no_order` varchar(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('draft','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'draft',
  `catatan` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `no_order`, `customer_id`, `user_id`, `total`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'SO-20240101-001', 1, 2, '10500000.00', 'selesai', 'Pengiriman ke gudang', '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(2, 'SO-20240102-002', 2, 3, '8500000.00', 'dikirim', NULL, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(3, 'SO-20240103-003', 3, 2, '3500000.00', 'draft', 'Tunggu konfirmasi', '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(4, 'SO-20240104-004', 4, 3, '6900000.00', 'dibatalkan', 'Pelanggan membatalkan', '2026-05-28 13:20:25', '2026-05-28 13:20:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `harga`, `subtotal`) VALUES
(1, 1, 1, 2, '3500000.00', '7000000.00'),
(2, 1, 3, 1, '3500000.00', '3500000.00'),
(3, 2, 6, 1, '8500000.00', '8500000.00'),
(4, 3, 1, 1, '3500000.00', '3500000.00'),
(5, 4, 4, 1, '2900000.00', '2900000.00'),
(6, 4, 8, 1, '1900000.00', '1900000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stok` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'PRD-001', 'TV LED Samsung 32\"', '3500000.00', 50, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(2, 'PRD-002', 'Kulkas Sharp 2 Pintu', '4200000.00', 30, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(3, 'PRD-003', 'AC Panasonic 1 PK', '3800000.00', 25, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(4, 'PRD-004', 'Mesin Cuci LG 7kg', '2900000.00', 40, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(5, 'PRD-005', 'Rice Cooker Miyako 1L', '350000.00', 100, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(6, 'PRD-006', 'Laptop Asus VivoBook', '8500000.00', 20, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(7, 'PRD-007', 'HP Xiaomi Redmi 12', '2100000.00', 60, '2026-05-28 13:20:25', '2026-05-28 13:20:25'),
(8, 'PRD-008', 'Speaker Bluetooth JBL', '750000.00', 80, '2026-05-28 13:20:25', '2026-05-28 13:20:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL DEFAULT 'sales',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-05-28 13:20:25'),
(2, 'Budi Santoso', 'budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sales', '2026-05-28 13:20:25'),
(3, 'Sari Dewi', 'sari', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sales', '2026-05-28 13:20:25'),
(4, 'Manajer Utama', 'manager', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'manager', '2026-05-28 13:20:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_order` (`no_order`),
  ADD KEY `fk_orders_customer` (`customer_id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_order` (`order_id`),
  ADD KEY `fk_detail_product` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_detail_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
