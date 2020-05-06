-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 05:49 AM
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
(1, 'admin2', 'admin');

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
  `foto` text NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`id_agen`, `nama_laundry`, `nama_pemilik`, `telp`, `email`, `kota`, `alamat`, `plat_driver`, `foto`, `password`) VALUES
(1, 'Nadya LaundryKu', 'Nadya Eka', '083123456789', 'agen1@gmail.com', 'Denpasar', 'Jl. Diponegoro No 55', 'DK 1234 AA', '5eab524e20d98.jpg', '$2y$10$tQ4th/nx/LLxYB7iHpbg4.FX1wdffLb5yplJIJsTdU6XlUCNPgEC6'),
(4, 'Laundry 2', 'Firdaus', '3875120', 'agen2@gmail.com', 'Surabaya', 'Jl. Surabaya No 12', 'DK 0000 AA', 'default.png', '$2y$10$mmXlXG97cauDgYemQwPjKuScxSjrnSrTZMH04bb1dosa7luvj1yUW'),
(5, 'Laundry WINA GANS', 'Wina Arth', '57109', 'agen3@gmail.com', 'Badung', 'Kuta No 22', 'DK 1234 AA', 'default.png', '$2y$10$tKrLGx8FMw8sCwuxIdUWgevKb0ikEozi8xseBV9CvBzUnUhOkHd1S'),
(7, 'Hairul Laundry', 'Hairul Lana', '08321456378', 'agen5@gmail.com', 'Karangasem', 'Jl. Mawar No 78', 'DK 5432 AB', 'default.png', '$2y$10$ldHD7JtlC26H.EuNf.kMPO9aamXxsO3yRWagW/gKzUrWjcWezq/eO'),
(9, 'Satan Laundry', 'Satan', '098527815618', 'agen6@gmail.com', 'Denpasar', 'Jl. Hehe No 77', 'DK 6666 DD', 'default.png', '$2y$10$IS1G8nhOpgY2EeVXppcz1u5sX.enw50eNYkRy9lli2wpnhlCu7PZG'),
(10, 'IBM Laundry', 'IBM Shava', '083123456789', 'agen4@gmail.com', 'Bangli', 'Jl. Sumatra No 33', 'DK 5555 SM', 'default.png', '$2y$10$OB2C9R4kUHrhGaMi3eF6z.DrDnQzapZhPZTucYh4I.ckes73MoFxy');

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
(1, 1, 11, '2020-04-25', '0000-00-00', 'setrika', 2, 1, 'Jl. Aceg No 44, Aceh', 'tak ada', 'Selesai'),
(2, 5, 8, '2020-04-25', '0000-00-00', 'komplit', 6, 4, 'Jl. Melati No 99, Denpasar', 'yang bersih yaaaa', 'Selesai'),
(3, 1, 11, '2020-04-26', '0000-00-00', 'cuci', 1, 5, 'Jl. Aceg No 44, Aceh', 'cepet ya', 'Selesai'),
(4, 4, 11, '2020-04-27', '0000-00-00', 'cuci', 1, 5, 'Jl. Aceg No 44, Aceh', 'cepet', 'Selesai'),
(5, 5, 11, '2020-04-27', '0000-00-00', 'komplit', 5, 6, 'Jl. Aceg No 44, Aceh', 'yg bersih y', 'Selesai'),
(6, 7, 9, '2020-04-27', '0000-00-00', 'setrika', 1, NULL, 'Jl. Goa Gong, No 99, Kec Kuta Selatan (Rumah warna hitam), Badung', 'ngebut ya\r\n', 'Penjemputan'),
(7, 5, 12, '2020-04-29', '0000-00-00', 'setrika', 4, 2, 'Jl. Umum No 77, Singaraja', 'yang sabar', 'Sedang Di Jemur'),
(8, 5, 12, '2020-05-06', '0000-00-00', 'setrika', 5, 3, 'Jl. Umum No 77, Singaraja', 'Yang Harum ya beb', 'Sedang di Cuci'),
(9, 5, 13, '2020-05-06', '0000-00-00', 'komplit', 1, 1, 'Jl. Semarang No 99, Semarang', 'tes', 'Selesai');

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
(18, 'komplit', 7, 4500),
(19, 'cuci', 8, 6000),
(20, 'setrika', 8, 3000),
(21, 'komplit', 8, 7500),
(22, 'cuci', 9, 4000),
(23, 'setrika', 9, 2000),
(24, 'komplit', 9, 5000),
(25, 'cuci', 10, 5000),
(26, 'setrika', 10, 3000),
(27, 'komplit', 10, 6000),
(28, 'cuci', 10, 5000),
(29, 'setrika', 10, 3000),
(30, 'komplit', 10, 6000);

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
  `foto` text NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `telp`, `kota`, `alamat`, `foto`, `password`) VALUES
(8, 'Pelanggan 1', 'pelanggan1@gmail.com', '0897654321', 'Denpasar', 'Jl. Melati No 99', 'default.png', '$2y$10$Q/LTUi2tH9UawYdI5ynTJe5vq.ga.mIKfTmr7ErtprUQgRkK.pmrG'),
(9, 'Nadya Eka', 'pelanggan2@gmail.com', '08123456789', 'Badung', 'Jl. Goa Gong, No 99, Kec Kuta Selatan (Rumah warna hitam)', 'default.png', '$2y$10$wvrs6fZ4riwS7j/QoQ1ERunXsVS3a4JBzmaGEMkZEE.2xRGjnVB5G'),
(11, 'Hairul Lana', 'pelanggan4@gmail.com', '082134567', 'Aceh', 'Jl. Aceg No 44', 'default.png', '$2y$10$XmHjcO/uFSqjtYnwdMAtG.wN/hFJaP2RmX4ObfKXHzYtWzrq88ml6'),
(12, 'Nadya Okta Via', 'pelanggan5@gmail.com', '089764532132', 'Singaraja', 'Jl. Umum No 77', '5eb222e525b06.jpg', '$2y$10$jxuKyuzIQS3wSYXxcOmde.d26tWIBPf1dpP01IVqDCdKSkkOmEGU.'),
(13, 'Riski Atma', 'pelanggan3@gmail.com', '09864738429', 'Semarang', 'Jl. Semarang No 99', 'default.png', '$2y$10$rv2iH7OayCjL6.84.9uA8.gaC4lTDzcxG.btFrB6JB4H4mNw5Vxpi');

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
(19, 4, 4, 11, '2020-04-27', '2020-04-27', 10000, 10, 'Reccomended'),
(20, 3, 1, 11, '2020-04-26', '2020-04-29', 10000, 10, 'Sangat cocok, agennya ramah sampe ke ubun ubun'),
(21, 2, 5, 8, '2020-04-25', '2020-05-06', 10000, 0, ''),
(22, 5, 5, 11, '2020-04-27', '2020-05-06', 15000, 0, ''),
(23, 9, 5, 13, '2020-05-06', '2020-05-06', 2500, 10, 'Sangat direkomendasikan');

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
  MODIFY `id_agen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cucian`
--
ALTER TABLE `cucian`
  MODIFY `id_cucian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `kode_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
