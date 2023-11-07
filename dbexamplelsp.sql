-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2023 pada 05.32
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
-- Database: `dbexamplelsp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli`
--

CREATE TABLE `tbl_beli` (
  `nofaktur` varchar(25) NOT NULL,
  `tgl` varchar(25) NOT NULL,
  `kode_brg` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_beli`
--

INSERT INTO `tbl_beli` (`nofaktur`, `tgl`, `kode_brg`, `qty`) VALUES
('BR001', '2023-11-06', 'BR003', 10),
('BR002', '2023-11-06', 'BR003', 10),
('BR003', '2023-11-06', 'BR001', 20),
('BR004', '2023-11-07', 'BR001', 3),
('BR005', '2023-11-07', 'BR003', 15),
('BR006', '2023-11-07', 'BR001', 10);

--
-- Trigger `tbl_beli`
--
DELIMITER $$
CREATE TRIGGER `Add_Stok_Barang` AFTER INSERT ON `tbl_beli` FOR EACH ROW UPDATE tbl_brg 
SET 
stok = stok + NEW.qty
WHERE
kode_brg = NEW.kode_brg
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_brg`
--

CREATE TABLE `tbl_brg` (
  `kode_brg` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_brg`
--

INSERT INTO `tbl_brg` (`kode_brg`, `nama`, `satuan`, `stok`) VALUES
('BR001', 'pensil', 'meter', 10),
('BR002', 'buku', 'gr', 15),
('BR003', '', '', 15),
('BR004', 'Tepung', '12', 0),
('BR005', 'sagu', 'kg', 0),
('BR006', 'gula', 'kg', 0),
('BR007', 'sagu', 'kg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual`
--

CREATE TABLE `tbl_jual` (
  `nofaktur` varchar(25) NOT NULL,
  `tgl` varchar(50) NOT NULL,
  `kode_brg` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jual`
--

INSERT INTO `tbl_jual` (`nofaktur`, `tgl`, `kode_brg`, `qty`) VALUES
('N001', '2023-11-07', 'BR001', 5),
('N002', '2023-11-07', 'BR001', 10);

--
-- Trigger `tbl_jual`
--
DELIMITER $$
CREATE TRIGGER `reduce_stok_tbl_brg` AFTER INSERT ON `tbl_jual` FOR EACH ROW UPDATE tbl_brg
SET
stok = stok - NEW.qty
WHERE 
kode_brg = NEW.kode_brg
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD PRIMARY KEY (`nofaktur`),
  ADD KEY `kode_brg` (`kode_brg`);

--
-- Indeks untuk tabel `tbl_brg`
--
ALTER TABLE `tbl_brg`
  ADD PRIMARY KEY (`kode_brg`);

--
-- Indeks untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD PRIMARY KEY (`nofaktur`),
  ADD KEY `kode_brg` (`kode_brg`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD CONSTRAINT `tbl_beli_ibfk_1` FOREIGN KEY (`kode_brg`) REFERENCES `tbl_brg` (`kode_brg`);

--
-- Ketidakleluasaan untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD CONSTRAINT `tbl_jual_ibfk_1` FOREIGN KEY (`kode_brg`) REFERENCES `tbl_brg` (`kode_brg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
