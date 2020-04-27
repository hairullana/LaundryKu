-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2020 at 08:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundryku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `id_agen` int(11) NOT NULL,
  `nama_laundry` varchar(30) DEFAULT NULL,
  `nama_pemilik` varchar(30) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `plat_driver` varchar(12) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`id_agen`, `nama_laundry`, `nama_pemilik`, `telp`, `email`, `kota`, `alamat`, `plat_driver`, `password`) VALUES
(1, 'Nadya Laundry', 'Nadya Eka', '083123456789', 'agen1', 'Denpasar', 'Jl. Diponegoro No 55', 'DK 1234 AA', '$2y$10$tQ4th/nx/LLxYB7iHpbg4.FX1wdffLb5yplJIJsTdU6XlUCNPgEC6'),
(4, 'Laundry 2', 'Firdaus', '3875120', 'agen2', 'Surabaya', 'Jl. Surabaya No 12', 'DK 0000 AA', '$2y$10$mmXlXG97cauDgYemQwPjKuScxSjrnSrTZMH04bb1dosa7luvj1yUW'),
(5, 'Laundry WINA GANS', 'Wina Arth', '57109', 'agen3', 'Badung', 'Kuta No 22', 'DK 1234 AA', '$2y$10$tKrLGx8FMw8sCwuxIdUWgevKb0ikEozi8xseBV9CvBzUnUhOkHd1S'),
(6, 'Ilmu Komputer', 'Pak Suhar', '234920', 'agen4', 'Denpasar', 'Jl. Pahlawan No 33', 'DK 1234 AA', '$2y$10$fU/QjqRFbjv4mTvRw8j7p.KhpEo/i8LKtcQ1SZhXgl/E2xsXrQY1O'),
(7, 'Hairul Laundry', 'Hairul Lana', '08321456378', 'agen5', 'Karangasem', 'Jl. Mawar No 78', 'DK 5432 AB', '$2y$10$ldHD7JtlC26H.EuNf.kMPO9aamXxsO3yRWagW/gKzUrWjcWezq/eO');

-- --------------------------------------------------------

--
-- Table structure for table `cucian`
--

CREATE TABLE `cucian` (
  `id_cucian` int(11) NOT NULL,
  `id_agen` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jenis` varchar(15) DEFAULT NULL,
  `total_item` int(11) DEFAULT NULL,
  `berat` double DEFAULT NULL,
  `alamat` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `status_cucian` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cucian`
--

INSERT INTO `cucian` (`id_cucian`, `id_agen`, `id_pelanggan`, `tgl_mulai`, `tgl_selesai`, `jenis`, `total_item`, `berat`, `alamat`, `catatan`, `status_cucian`) VALUES
(1, 1, 11, '2020-04-25', '0000-00-00', 'Setrika', 2, 1, 'Jl. Aceg No 44, Aceh', 'tak ada', 'Selesai'),
(2, 5, 8, '2020-04-25', '0000-00-00', 'Cuci + Setrika', 6, NULL, 'Jl. Melati No 99, Denpasar', 'yang bersih yaaaa', 'Penjemputan'),
(3, 1, 11, '2020-04-26', '0000-00-00', 'Cuci', 1, 5, 'Jl. Aceg No 44, Aceh', 'cepet ya', 'Sedang Di Jemur'),
(4, 4, 11, '2020-04-27', '0000-00-00', 'Cuci', 1, 5, 'Jl. Aceg No 44, Aceh', 'cepet', 'Selesai'),
(5, 5, 11, '2020-04-27', '0000-00-00', 'Cuci + Setrika', 5, NULL, 'Jl. Aceg No 44, Aceh', 'yg bersih y', 'Penjemputan'),
(6, 7, 9, '2020-04-27', '0000-00-00', 'Setrika', 1, NULL, 'Jl. Goa Gong, No 99, Kec Kuta Selatan (Rumah warna hitam), Badung', 'ngebut ya\r\n', 'Penjemputan');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `id_agen` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `jenis`, `id_agen`, `harga`) VALUES
(1, 'cuci', 3, 2000),
(2, 'setrika', 3, 1000),
(3, 'komplit', 3, 2500),
(4, 'cuci', 1, 5000),
(5, 'setrika', 1, 3000),
(6, 'komplit', 1, 7000),
(7, 'cuci', 4, 300),
(8, 'setrika', 4, 200),
(9, 'komplit', 4, 400),
(10, 'cuci', 5, 4000),
(11, 'setrika', 5, 3000),
(12, 'komplit', 5, 5000),
(13, 'cuci', 6, 7000),
(14, 'setrika', 6, 3000),
(15, 'komplit', 6, 8000),
(16, 'cuci', 7, 3000),
(17, 'setrika', 7, 2000),
(18, 'komplit', 7, 4500);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `kota` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `telp`, `kota`, `alamat`, `password`) VALUES
(8, 'Pelanggan 1', 'pelanggan1', '0897654321', 'Denpasar', 'Jl. Melati No 99', '$2y$10$Q/LTUi2tH9UawYdI5ynTJe5vq.ga.mIKfTmr7ErtprUQgRkK.pmrG'),
(9, 'Wina Gans', 'pelanggan2', '08123456789', 'Badung', 'Jl. Goa Gong, No 99, Kec Kuta Selatan (Rumah warna hitam)', '$2y$10$wvrs6fZ4riwS7j/QoQ1ERunXsVS3a4JBzmaGEMkZEE.2xRGjnVB5G'),
(10, 'I Nyoman Wina Artha Setiawan', 'pelanggan3', '08765431928', 'Jember', 'Jl Jember No 33', '$2y$10$z29FSDrYVJlw78g892s5U.7FUz9etIPTCaMK/tQzG6r8f1xuv9Vdu'),
(11, 'Hairul Lana', 'pelanggan4', '082134567', 'Aceh', 'Jl. Aceg No 44', '$2y$10$XmHjcO/uFSqjtYnwdMAtG.wN/hFJaP2RmX4ObfKXHzYtWzrq88ml6');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` int(11) NOT NULL,
  `id_cucian` int(11) NOT NULL,
  `id_agen` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `id_cucian`, `id_agen`, `id_pelanggan`, `tgl_mulai`, `tgl_selesai`, `total_bayar`, `rating`, `komentar`) VALUES
(6, 1, 1, 11, '2020-04-25', '2020-04-26', 1000, 6, 'Mantap'),
(19, 4, 4, 11, '2020-04-27', '2020-04-27', 10000, 10, 'Reccomended');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id_agen`);

--
-- Indexes for table `cucian`
--
ALTER TABLE `cucian`
  ADD PRIMARY KEY (`id_cucian`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id_agen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cucian`
--
ALTER TABLE `cucian`
  MODIFY `id_cucian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `kode_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
