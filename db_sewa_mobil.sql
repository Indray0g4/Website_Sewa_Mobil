-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2020 at 01:45 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sewa_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `id_mobil` int(5) NOT NULL,
  `nama_pemilik_mobil` varchar(100) NOT NULL,
  `merk_mobil` varchar(100) NOT NULL,
  `jenis_transmisi` enum('Manual','Matic') NOT NULL,
  `harga_sewa` int(6) NOT NULL,
  `jumlah_mobil` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`id_mobil`, `nama_pemilik_mobil`, `merk_mobil`, `jenis_transmisi`, `harga_sewa`, `jumlah_mobil`) VALUES
(5, 'Syakhinatun', 'Honda', 'Matic', 850000, 30),
(6, 'Fitri', 'Avanza', 'Manual', 500000, 28),
(7, 'Serly', 'Suzuki', 'Matic', 550000, 22),
(8, 'Diaz', 'Mitsubi', 'Manual', 750000, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewa`
--

CREATE TABLE `tb_sewa` (
  `id_sewa` int(5) NOT NULL,
  `no_sewa` int(3) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `id_mobil` int(5) NOT NULL,
  `jumlah_sewa` int(4) NOT NULL,
  `nama_penyewa` varchar(255) NOT NULL,
  `keterangan` enum('Pinjam','Kembali') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sewa`
--

INSERT INTO `tb_sewa` (`id_sewa`, `no_sewa`, `tgl_sewa`, `id_mobil`, `jumlah_sewa`, `nama_penyewa`, `keterangan`) VALUES
(16, 746, '2020-02-04', 8, 2, 'Fikri', 'Pinjam'),
(17, 746, '2020-02-04', 5, 2, 'Fikri', 'Pinjam'),
(19, 838, '2020-02-04', 6, 2, 'Galih', 'Pinjam');

--
-- Triggers `tb_sewa`
--
DELIMITER $$
CREATE TRIGGER `kurang_mobil` AFTER INSERT ON `tb_sewa` FOR EACH ROW UPDATE tb_mobil SET jumlah_mobil = jumlah_mobil-NEW.jumlah_sewa
WHERE id_mobil = NEW.id_mobil
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER DELETE ON `tb_sewa` FOR EACH ROW UPDATE tb_mobil SET jumlah_mobil = jumlah_mobil+OLD.jumlah_sewa
WHERE id_mobil = OLD.id_mobil
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  MODIFY `id_sewa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
