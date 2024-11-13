-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Nov 2024 pada 20.52
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akhmad_yazid_bustomi_001`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 'Meja Kantor Minimalis', 1500000.00, 9, '-', '2024-11-13 15:13:31', '2024-11-13 19:50:01'),
(6, 'Kursi Gaming', 2300000.00, 21, 'kursi gaming RGB', '2024-11-13 15:13:56', '2024-11-13 19:46:06'),
(7, 'Lemari Pakaian', 3000000.00, 2, 'Lemari pakaian 2 pintu 1 kaca', '2024-11-13 15:14:28', '2024-11-13 19:47:42'),
(8, 'Meja Makan Kayu Jati', 5600000.00, 9, 'meja makan + 4 kursi kayu jati', '2024-11-13 15:15:07', '2024-10-22 18:06:41'),
(9, 'Rak Buku', 960000.00, 14, '', '2024-11-13 15:15:31', '2024-10-22 18:06:21'),
(10, 'Tempat Tidur Queen', 4500000.00, 6, 'Ukuran 2 x 3.5', '2024-11-13 15:16:07', '2024-10-22 18:06:28'),
(11, 'Meja Rias', 3200000.00, 12, 'meja rias + cermin', '2024-11-13 15:16:46', '2024-10-22 18:06:11'),
(12, 'Kursi Tamu', 2300000.00, 9, 'Kursi tamu 2 set', '2024-11-13 15:17:24', '2024-10-22 18:06:17'),
(13, 'Rak TV', 650000.00, 8, 'Rak TV minimalis', '2024-11-13 15:18:13', '2024-10-22 18:06:06'),
(14, 'Meja Kerja Lipat', 150000.00, 3, 'Meja kerja lipat minimalis dan nyaman', '2024-11-13 15:18:52', '2024-10-22 18:05:19'),
(15, 'Kursi Bar ', 930000.00, 6, 'kursi bar minimalis isi 2', '2024-11-13 15:19:28', '2024-09-04 18:03:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_produk`, `jumlah`, `total_harga`, `tanggal`) VALUES
(7, 5, 3, 4500000.00, '2024-11-13'),
(8, 6, 10, 23000000.00, '2024-11-13'),
(10, 5, 2, 3000000.00, '2024-07-02'),
(11, 8, 1, 5600000.00, '2024-07-02'),
(12, 13, 4, 2600000.00, '2024-07-02'),
(13, 15, 1, 930000.00, '2024-07-02'),
(14, 5, 1, 1500000.00, '2024-08-02'),
(15, 8, 2, 11200000.00, '2024-08-02'),
(16, 10, 1, 4500000.00, '2024-08-02'),
(17, 11, 2, 6400000.00, '2024-08-02'),
(18, 6, 2, 4600000.00, '2024-08-02'),
(20, 9, 3, 2880000.00, '2024-08-02'),
(23, 15, 2, 1860000.00, '2024-09-04'),
(24, 6, 4, 9200000.00, '2024-09-04'),
(25, 10, 2, 9000000.00, '2024-09-04'),
(26, 10, 2, 9000000.00, '2024-10-22'),
(27, 13, 3, 1950000.00, '2024-10-22'),
(28, 5, 2, 3000000.00, '2024-10-22'),
(29, 7, 1, 3000000.00, '2024-10-22'),
(30, 6, 3, 6900000.00, '2024-10-22'),
(31, 11, 2, 6400000.00, '2024-10-22'),
(32, 14, 4, 600000.00, '2024-10-22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `forgkey_produk_transaksi` (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `forgkey_produk_transaksi` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
