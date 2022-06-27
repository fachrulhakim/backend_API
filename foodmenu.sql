-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Jun 2022 pada 17.53
-- Versi server: 5.7.24
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodmenu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(255) NOT NULL,
  `nama_kategori` varchar(120) NOT NULL,
  `status_kategori` enum('Active','Deactive') NOT NULL,
  `gambar_kategori` varchar(255) NOT NULL,
  `tanggal_buat` varchar(20) NOT NULL,
  `tanggal_update` varchar(20) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id_pemesanan` int(255) NOT NULL,
  `id_produk` int(255) NOT NULL,
  `nama_pemesan` varchar(120) NOT NULL,
  `email_pemesan` varchar(120) NOT NULL,
  `nohp_pemesan` char(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jumlah_pemesanan` int(11) NOT NULL,
  `total_harga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(255) NOT NULL,
  `id_kategori` int(25) NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `harga_produk` char(10) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `status_produk` enum('Available','NotAvailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  MODIFY `id_pemesanan` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
