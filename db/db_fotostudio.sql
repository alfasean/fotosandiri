-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Apr 2024 pada 07.23
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fotostudio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bukti`
--

CREATE TABLE `tb_bukti` (
  `id_bukti` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_frame`
--

CREATE TABLE `tb_frame` (
  `id_frame` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_frame`
--

INSERT INTO `tb_frame` (`id_frame`, `foto`) VALUES
(1, '1.png'),
(4, 'ew.png'),
(5, 'ea.png'),
(6, 'ead.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `kategori` enum('selfphoto','sebox') NOT NULL,
  `harga` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `nama_paket`, `kategori`, `harga`, `foto`) VALUES
(10, 'Sebox Poster - Single', 'sebox', '35000', 'price1.png'),
(11, 'Sebox Poster - Double', 'sebox', '50000', 'price1.png'),
(12, 'Sebox Light - Single', 'sebox', '30000', 'price4.png'),
(13, 'Sebox Light - Double ', 'sebox', '40000', 'price4.png'),
(15, 'Selfphoto Backgrund', 'selfphoto', '75000', 'price2.png'),
(16, 'Selfphoto Polos', 'selfphoto', '70000', 'price2.png'),
(17, 'Sebox dan Selfphoto', 'selfphoto', '100000', 'price3.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_waktu_reservasi` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `total` varchar(50) NOT NULL,
  `metode_pembayaran` enum('cash','transfer') NOT NULL,
  `konfirmasi` enum('belum_konfirmasi','konfirmasi') NOT NULL DEFAULT 'belum_konfirmasi',
  `ex_cetak` enum('tidak','ya') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sebox`
--

CREATE TABLE `tb_sebox` (
  `id_sebox` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_sebox`
--

INSERT INTO `tb_sebox` (`id_sebox`, `foto`) VALUES
(2, 'gambar3.jpg'),
(3, 'gambar4.jpg'),
(4, 'gambar5.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_selfphoto`
--

CREATE TABLE `tb_selfphoto` (
  `id_selfphoto` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_selfphoto`
--

INSERT INTO `tb_selfphoto` (`id_selfphoto`, `foto`) VALUES
(1, '2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_waktu_reservasi`
--

CREATE TABLE `tb_waktu_reservasi` (
  `id_waktu_reservasi` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_waktu_reservasi`
--

INSERT INTO `tb_waktu_reservasi` (`id_waktu_reservasi`, `start_time`, `end_time`, `available`) VALUES
(1, '09:30:00', '10:00:00', 1),
(2, '11:00:00', '12:25:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_bukti`
--
ALTER TABLE `tb_bukti`
  ADD PRIMARY KEY (`id_bukti`);

--
-- Indeks untuk tabel `tb_frame`
--
ALTER TABLE `tb_frame`
  ADD PRIMARY KEY (`id_frame`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indeks untuk tabel `tb_sebox`
--
ALTER TABLE `tb_sebox`
  ADD PRIMARY KEY (`id_sebox`);

--
-- Indeks untuk tabel `tb_selfphoto`
--
ALTER TABLE `tb_selfphoto`
  ADD PRIMARY KEY (`id_selfphoto`);

--
-- Indeks untuk tabel `tb_waktu_reservasi`
--
ALTER TABLE `tb_waktu_reservasi`
  ADD PRIMARY KEY (`id_waktu_reservasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_bukti`
--
ALTER TABLE `tb_bukti`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_frame`
--
ALTER TABLE `tb_frame`
  MODIFY `id_frame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_sebox`
--
ALTER TABLE `tb_sebox`
  MODIFY `id_sebox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_selfphoto`
--
ALTER TABLE `tb_selfphoto`
  MODIFY `id_selfphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_waktu_reservasi`
--
ALTER TABLE `tb_waktu_reservasi`
  MODIFY `id_waktu_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
