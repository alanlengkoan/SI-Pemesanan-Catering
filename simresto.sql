-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2019 pada 14.53
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simresto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `uid` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`uid`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`) VALUES
('1', 'admin', '$2y$10$ISXZSXktGgt2RJWt5MA7y.NjYUsNueHKmcH4d4tn3uuNe.23OGtC.', 'Administrator', 'webmaster@sixghakreasi.com', '08238923848', 'admin', 'N'),
('UID-0003', 'yerwin', '$2y$10$FHA6tEKKYWRtoavO2qpife1jmd7j8YLUygKj/7bcb/l0.7mMBoI0O', 'Yerwin Toga Sambolangi', 'yerwin@gmail.com', '2121212', 'user', 'N'),
('UID-0002', 'alanlengkoan', '$2y$10$ZOq9h1A/4o6KSE0yFcHTZuyWsKNzaJvBq4W8N0GbeNOA5/WUAUDva', 'Alan Saputra Lengkoan', 'alanlengkoan15@gmail.com', '123123123', 'user', 'N'),
('UID-0004', 'allen', '$2y$10$3zdxP05zjjUC8k4rrW5/U.zUUjONzFn6wpGPAxG9jED1Auwrc9c6C', 'Alan Lengkoan', 'alanlengkoan15@gmail.com', '121212', 'kurir', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dataimage`
--

CREATE TABLE `dataimage` (
  `id_orders` varchar(10) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `transfer` varchar(20) NOT NULL,
  `sisah` varchar(20) NOT NULL,
  `bank` text NOT NULL,
  `no_rek` varchar(20) NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `image2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dataimage`
--

INSERT INTO `dataimage` (`id_orders`, `uid`, `nama`, `transfer`, `sisah`, `bank`, `no_rek`, `status_pembayaran`, `image`, `image2`) VALUES
('ODR-0001', 'UID-0002', 'Alan Lengkoan', '25000', '0', '22', '22', 'Lunas', '120px-Home_Icon.svg.png', 'Academic-Calendar-icon.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hubungi`
--

CREATE TABLE `hubungi` (
  `id_hubungi` int(5) NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`) VALUES
(1, 'Alan Lengkoan', 'alanlengkoan15@gmail.com', 'asd', 'asdasdajhsgdhvf sgf sdfjh akjshfb', '2018-12-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_seo`) VALUES
(16, 'Minuman', 'minuman'),
(15, 'Makanan', 'makanan'),
(10, 'Menu Utama', 'menu-utama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_orders` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `uid` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `nama_kustomer` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `telpon` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `status_pembayaran` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `jam_p` time NOT NULL,
  `tgl_p` date NOT NULL,
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_orders`, `uid`, `nama_kustomer`, `alamat`, `telpon`, `email`, `status_order`, `status_pembayaran`, `jam_p`, `tgl_p`, `tgl_order`, `jam_order`) VALUES
('ODR-0001', 'UID-0002', 'Alan Saputra Lengkoan', 'asdas', '123123123', 'alanlengkoan15@gmail.com', 'Lunas', 'Lunas', '22:16:46', '2019-01-07', '2019-01-07', '23:04:40');

--
-- Trigger `orders`
--
DELIMITER $$
CREATE TRIGGER `delete` AFTER DELETE ON `orders` FOR EACH ROW begin
DELETE FROM orders_detail WHERE id_orders = old.id_orders;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `id_produk` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `total` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `transfer` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `sisah` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`, `harga`, `total`, `transfer`, `sisah`) VALUES
('ODR-0001', 'PDR-0002', 1, '15000', '25000', '25000', '0'),
('ODR-0001', 'PDR-0004', 1, '10000', '25000', '25000', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `id_produk` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `orders_temp`
--

INSERT INTO `orders_temp` (`id_orders_temp`, `id_produk`, `id_session`, `jumlah`, `harga`, `tgl_order_temp`, `jam_order_temp`, `stok_temp`) VALUES
(1, 'PDR-0002', 'rj65i58kd65jnpr4m176fm1onu', 1, '15000', '2019-01-07', '15:42:52', 9),
(2, 'PDR-0004', 'rj65i58kd65jnpr4m176fm1onu', 1, '10000', '2019-01-07', '15:43:02', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `produk_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga_p` int(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibeli` int(5) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `produk_seo`, `deskripsi`, `harga_p`, `stok`, `berat`, `tgl_masuk`, `gambar`, `dibeli`) VALUES
('PDR-0001', 15, 'Nasi Goreng', 'nasi-goreng', '<p>enak kali</p>', 20000, 8, '0.00', '2018-12-06', '83nasgor.jpg', 27),
('PDR-0002', 15, 'Mie Goreng', 'mie-goreng', '<p>Mantap Kali</p>', 15000, 8, '0.00', '2018-12-06', '52miegor.jpg', 27),
('PDR-0003', 16, 'Es Teh', 'es-teh', '<p>mantap</p>', 5000, 8, '0.00', '2018-12-06', '53esteh.jpg', 27),
('PDR-0004', 16, 'Es Buah', 'es-buah', '<p>segar</p>', 10000, 8, '0.00', '2018-12-06', '98esbuah.jpg', 27);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`uid`);

--
-- Indeks untuk tabel `dataimage`
--
ALTER TABLE `dataimage`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indeks untuk tabel `hubungi`
--
ALTER TABLE `hubungi`
  ADD PRIMARY KEY (`id_hubungi`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indeks untuk tabel `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hubungi`
--
ALTER TABLE `hubungi`
  MODIFY `id_hubungi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
