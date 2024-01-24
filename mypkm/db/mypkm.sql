-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2024 pada 08.27
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `status` enum('OFF','ON') NOT NULL,
  `foto` longtext NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `username`, `password`, `status`, `foto`, `role`) VALUES
(1, 'administrator 1', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'OFF', '1703338450_2f39b8ffd8c880bfde62.jpg', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akademik`
--

CREATE TABLE `tb_akademik` (
  `id_akademik` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `role` enum('KABAG','KASUBAG','WADIR') NOT NULL,
  `foto` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_akademik`
--

INSERT INTO `tb_akademik` (`id_akademik`, `nip`, `nama`, `email`, `username`, `password`, `role`, `foto`) VALUES
(2, '34434', 'Kepala Bagian', 'kasubag@polinela.ac.id', 'kabag', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'KABAG', '1703463554_b2121b0086da2edb1aa0.jpg'),
(3, '2343254', 'Kepala Sub Bagian', 'kasubag@polinela.ac.id', 'kasubag', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'KASUBAG', '1703464682_74a9adc6f2a74b9195ef.jpg'),
(4, '198110212003121002', 'Agung Adi Candra, S.K.h., M.Si', 'wadir@polinela.ac.id', 'wadir', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'WADIR', '1703464784_d9d8fbd7c6a8428441fe.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `laporan` longtext NOT NULL,
  `val_kabag` enum('Belum','Sudah') NOT NULL,
  `val_kasubag` enum('Belum','Sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `tanggal`, `laporan`, `val_kabag`, `val_kasubag`) VALUES
(10, '2024-01-16', 'laporan_mahasiswa_bed92.pdf', 'Sudah', 'Sudah'),
(11, '2024-01-16', 'laporan_mahasiswa_33c1b.pdf', 'Belum', 'Belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `npm` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_hp` varchar(14) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status_akun` enum('aktif','nonaktif') DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `prodi` varchar(50) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `npm`, `nama`, `email`, `alamat`, `tgl_lahir`, `no_hp`, `password`, `status_akun`, `dokumen`, `prodi`, `semester`) VALUES
(6, '130206', 'Freya Jayawardana', 'freya@gmail.com', 'Tanggerang Selatan', '2018-03-02', '0821212121212', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'aktif', 'sudah', 'D3 Manajemen Infromatika', '3'),
(11, '130507', 'Flora Syafiq', 'bycevewyri@mailinator.com', 'Adipisicing eum vita', '2021-08-17', '9012313123131', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'aktif', 'belum', 'D3 Manajemen Infromatika', '5'),
(12, '130608', 'azizi syafa asadel', 'azizi@jkt.com', 'Jalan Mawar', '2023-12-31', '09128172', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'nonaktif', 'belum', 'D3 Manajemen Infromatika', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_usulan`
--

CREATE TABLE `tb_usulan` (
  `id_usulan` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `proposal` longtext DEFAULT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `id_belmawa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_usulan`
--

INSERT INTO `tb_usulan` (`id_usulan`, `id_mahasiswa`, `judul`, `proposal`, `tahun_ajaran`, `id_belmawa`) VALUES
(25, 6, 'Menciptakan aplikasi cbt untuk polinela', 'proposal_659d6519e9259bc555766faa033f8fe3.pdf', '2023', '3124234e32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_akademik`
--
ALTER TABLE `tb_akademik`
  ADD PRIMARY KEY (`id_akademik`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `tb_usulan`
--
ALTER TABLE `tb_usulan`
  ADD PRIMARY KEY (`id_usulan`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_akademik`
--
ALTER TABLE `tb_akademik`
  MODIFY `id_akademik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_usulan`
--
ALTER TABLE `tb_usulan`
  MODIFY `id_usulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_usulan`
--
ALTER TABLE `tb_usulan`
  ADD CONSTRAINT `tb_usulan_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
