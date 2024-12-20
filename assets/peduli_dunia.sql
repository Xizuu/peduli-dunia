-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2024 pada 07.49
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
-- Database: `peduli_dunia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`) VALUES
(2, 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `id` int(11) NOT NULL,
  `id_donatur` int(11) DEFAULT NULL,
  `id_lembaga_sosial` int(11) DEFAULT NULL,
  `nominal` decimal(15,2) DEFAULT NULL,
  `tanggal_donasi` datetime DEFAULT NULL,
  `status` enum('pending','success','error') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id`, `id_donatur`, `id_lembaga_sosial`, `nominal`, `tanggal_donasi`, `status`) VALUES
(3, 2, 9, 20000.00, NULL, 'success');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donatur`
--

CREATE TABLE `donatur` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donatur`
--

INSERT INTO `donatur` (`id`, `nama`, `email`, `password`) VALUES
(2, 'donatur', 'donatur@gmail.com', 'af1ceca477c8935b2978fa1a84782595');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembaga_sosial`
--

CREATE TABLE `lembaga_sosial` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lembaga_sosial`
--

INSERT INTO `lembaga_sosial` (`id`, `nama`, `kategori`, `deskripsi`) VALUES
(9, 'Sekolah Dasar', 'pendidikan', 'Lembaga sekolah dasar'),
(10, 'Puskesmas', 'kesehatan', 'Lembaga Kesehatan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_donatur` (`id_donatur`),
  ADD KEY `fk_donasi_lembaga` (`id_lembaga_sosial`);

--
-- Indeks untuk tabel `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lembaga_sosial`
--
ALTER TABLE `lembaga_sosial`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lembaga_sosial`
--
ALTER TABLE `lembaga_sosial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD CONSTRAINT `donasi_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `donatur` (`id`),
  ADD CONSTRAINT `donasi_ibfk_2` FOREIGN KEY (`id_lembaga_sosial`) REFERENCES `lembaga_sosial` (`id`),
  ADD CONSTRAINT `fk_donasi_lembaga` FOREIGN KEY (`id_lembaga_sosial`) REFERENCES `lembaga_sosial` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
