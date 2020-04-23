-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2018 at 05:59 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acc_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_login`
--

CREATE TABLE `akun_login` (
  `id_akun` int(11) NOT NULL,
  `nama_pengguna` varchar(25) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun_login`
--

INSERT INTO `akun_login` (`id_akun`, `nama_pengguna`, `kata_sandi`, `status`, `nama_lengkap`, `id_jabatan`, `id_divisi`, `img`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 1, 'Administrator', 0, 0, NULL),
(13, 'akd.maria', '0192023a7bbd73250516f069df18b500', 2, 'Maria Maksimiana M, S.AP', 1, 1, '1512022942.jpg'),
(14, 'akd.nanang', '6797f82f504379e72c59879b12594d39', 2, 'Nanang Suryadi', 2, 1, '1512023024.jpg'),
(15, 'akd.nesti', 'ded4a12f9cf070041ecccd3c7501b2b8', 2, 'Nesti Febriyanah', 2, 1, '1513307214.jpg'),
(16, 'cnp.ovi', '0192023a7bbd73250516f069df18b500', 2, 'Ovi Chandra, A.Md', 3, 2, '1513045732.jpg'),
(17, 'yohana', '0192023a7bbd73250516f069df18b500', 2, 'Yohana Ria, A.Md', 4, 2, '1513045772.jpg'),
(18, 'alam', 'c66187a0575df6352d28f01b80b39f40', 2, 'Alam Adi Putra', 8, 6, '1513046282.jpg'),
(19, 'rachma', '35d82d6e1cf9d78d65b9cdd0f0345d86', 2, 'Rachma Chairunissa Fajrin', 9, 4, '1513046357.jpg'),
(20, 'samsu', 'ea640ae7c65955ee2503ae7367520e93', 2, 'Samsu Syafe\'i', 10, 5, '1513046730.jpg'),
(21, 'ella', 'd2b59889c9f6275609514b85f7e19b12', 2, 'Nur Sa\'adatul Kamilah', 10, 5, '1513047085.jpg'),
(22, 'ict.rifki', 'c295381004ba44f97c28dc6b8a2ab6c9', 2, 'Rifki Pintokoaji, S.Kom', 6, 3, '1513307375.jpg'),
(23, 'psr.theo', '53d9dc493543ec1eaef8d4d6e783e053', 2, 'Matheus Y Molelawe, A.Md', 9, 4, '1513307613.jpg'),
(24, 'wkk.eddy', '971730b40144291e40f4d96f10f43fcb', 2, 'Eddy Suwarno, S.Kom', 99, 0, '1513307739.jpg'),
(25, 'kpl.suarna', '0192023a7bbd73250516f069df18b500', 2, 'A. Suarna Dijaya', 100, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_login`
--
ALTER TABLE `akun_login`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_login`
--
ALTER TABLE `akun_login`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
