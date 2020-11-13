-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2020 at 02:44 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nbnur`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset_kasus`
--

CREATE TABLE `dataset_kasus` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenkel` int(1) NOT NULL,
  `usia_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `pekerjaan_id` int(11) NOT NULL,
  `penghasilan_id` int(11) NOT NULL,
  `asuransi_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `klasifikasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dataset_kasus`
--

INSERT INTO `dataset_kasus` (`id`, `nama`, `jenkel`, `usia_id`, `status`, `pekerjaan_id`, `penghasilan_id`, `asuransi_id`, `pembayaran_id`, `klasifikasi_id`) VALUES
(1, '', 1, 2, 1, 1, 1, 3, 1, 3),
(2, '', 2, 2, 1, 1, 1, 1, 2, 2),
(3, '', 2, 1, 1, 2, 1, 1, 3, 3),
(4, '', 2, 2, 2, 1, 1, 1, 3, 2),
(5, '', 1, 2, 1, 3, 1, 1, 1, 1),
(6, '', 1, 2, 2, 3, 3, 2, 2, 2),
(7, '', 1, 2, 1, 1, 2, 2, 2, 3),
(8, '', 2, 1, 1, 3, 2, 2, 1, 2),
(9, '', 2, 1, 1, 3, 1, 2, 3, 3),
(10, '', 1, 1, 1, 1, 1, 2, 3, 1),
(11, '', 1, 2, 2, 3, 2, 2, 1, 2),
(12, '', 2, 2, 1, 3, 2, 3, 1, 1),
(13, '', 1, 2, 1, 3, 3, 2, 3, 2),
(14, '', 2, 3, 1, 1, 1, 3, 2, 1),
(15, '', 1, 1, 2, 1, 1, 2, 1, 2),
(16, '', 1, 2, 2, 3, 1, 2, 2, 2),
(17, '', 1, 3, 1, 2, 1, 2, 1, 3),
(18, '', 1, 2, 1, 2, 2, 2, 1, 3),
(19, '', 2, 2, 1, 3, 1, 2, 3, 2),
(20, '', 2, 1, 2, 3, 2, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asuransi`
--

CREATE TABLE `tbl_asuransi` (
  `id` int(11) NOT NULL,
  `masa` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_asuransi`
--

INSERT INTO `tbl_asuransi` (`id`, `masa`) VALUES
(1, '5 - 10 Tahun'),
(2, '11 - 15 Tahun'),
(3, '> 15 Tahun');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_klasifikasi`
--

CREATE TABLE `tbl_klasifikasi` (
  `id` int(11) NOT NULL,
  `klasifikasi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_klasifikasi`
--

INSERT INTO `tbl_klasifikasi` (`id`, `klasifikasi`) VALUES
(1, 'Kurang Lancar'),
(2, 'Lancar'),
(3, 'Tidak Lancar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pekerjaan`
--

CREATE TABLE `tbl_pekerjaan` (
  `id` int(11) NOT NULL,
  `nama_pekerjaan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pekerjaan`
--

INSERT INTO `tbl_pekerjaan` (`id`, `nama_pekerjaan`) VALUES
(1, 'PNS'),
(2, 'Pegawai Swasta'),
(3, 'Wiraswasta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id` int(11) NOT NULL,
  `cara` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id`, `cara`) VALUES
(1, 'Tahunan'),
(2, 'Semesteran'),
(3, 'Triwulan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penghasilan`
--

CREATE TABLE `tbl_penghasilan` (
  `id` int(11) NOT NULL,
  `jumlah_penghasilan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penghasilan`
--

INSERT INTO `tbl_penghasilan` (`id`, `jumlah_penghasilan`) VALUES
(1, '< 25 Juta'),
(2, '25 - 50 Juta'),
(3, '> 50 Juta');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usia`
--

CREATE TABLE `tbl_usia` (
  `id` int(11) NOT NULL,
  `usia` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usia`
--

INSERT INTO `tbl_usia` (`id`, `usia`) VALUES
(1, '20 - 29'),
(2, '30 - 40'),
(3, '> 40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset_kasus`
--
ALTER TABLE `dataset_kasus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_asuransi`
--
ALTER TABLE `tbl_asuransi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pekerjaan`
--
ALTER TABLE `tbl_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penghasilan`
--
ALTER TABLE `tbl_penghasilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_usia`
--
ALTER TABLE `tbl_usia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset_kasus`
--
ALTER TABLE `dataset_kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_asuransi`
--
ALTER TABLE `tbl_asuransi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pekerjaan`
--
ALTER TABLE `tbl_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_penghasilan`
--
ALTER TABLE `tbl_penghasilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_usia`
--
ALTER TABLE `tbl_usia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
