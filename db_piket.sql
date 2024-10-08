-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Okt 2024 pada 13.29
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
-- Database: `db_piket`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tanggal_izin` datetime DEFAULT NULL,
  `waktu_kembali` varchar(50) NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `jk` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `namaguru` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `nama_siswa`, `jurusan`, `kelas`, `tanggal_izin`, `waktu_kembali`, `alasan`, `status`, `jk`, `tlp`, `namaguru`, `jabatan`) VALUES
(32, 'Shafin alif firdaus', 'RPL', '12', '2024-10-08 18:13:00', '', 'sakit', 'Izin pulang', 'LK', '62881025364631', '', ''),
(33, 'Annisa Azzahra', 'Kuliner', '12', '2024-10-08 18:14:00', '', 'ngeprint', 'Izin keluar', 'PR', '6287777599602', '', ''),
(34, 'Annisa Azzahra', 'RPL', '12', '2024-10-08 18:21:00', '', 'ngeprint', 'Izin pulang', 'LK', '6287777599602', '', ''),
(35, 'Annisa Azzahra', 'RPL', '12', '2024-10-08 18:21:00', '', 'ngeprint', 'Izin pulang', 'LK', '6287777599602', '', ''),
(36, 'Annisa Azzahra', 'RPL', '12', '2024-10-08 18:21:00', '', 'ngeprint', 'Izin pulang', 'LK', '6287777599602', '', ''),
(37, 'Annisa Azzahra', 'RPL', '12', '2024-10-08 18:21:00', '', 'ngeprint', 'Izin pulang', 'LK', '6287777599602', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjaga_piket`
--

CREATE TABLE `penjaga_piket` (
  `id` int(11) NOT NULL,
  `namaguru` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_izinkeluar`
--

CREATE TABLE `siswa_izinkeluar` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tanggal_izin` datetime DEFAULT NULL,
  `waktu_kembali` varchar(50) NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `jk` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `namaguru` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_izinpulang`
--

CREATE TABLE `siswa_izinpulang` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tanggal_izin` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `jk` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `alasan` varchar(50) NOT NULL,
  `namaguru` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `foto`) VALUES
(21, 'muludorah123@gmail.com', 'admin', '123', 0x32373634646133662d396166632d343637352d613735352d626662623934306230343834202831292e6a706567);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjaga_piket`
--
ALTER TABLE `penjaga_piket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa_izinkeluar`
--
ALTER TABLE `siswa_izinkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa_izinpulang`
--
ALTER TABLE `siswa_izinpulang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `penjaga_piket`
--
ALTER TABLE `penjaga_piket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `siswa_izinkeluar`
--
ALTER TABLE `siswa_izinkeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `siswa_izinpulang`
--
ALTER TABLE `siswa_izinpulang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
