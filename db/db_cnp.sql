-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2018 at 04:10 AM
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
-- Database: `db_cnp`
--

-- --------------------------------------------------------

--
-- Table structure for table `header_ujian`
--

CREATE TABLE `header_ujian` (
  `id_headersoal` int(11) NOT NULL,
  `nama_ujian` varchar(50) NOT NULL,
  `tgl_ujian` varchar(25) NOT NULL,
  `jam_mulai` varchar(15) NOT NULL,
  `jam_akhir` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header_ujian`
--

INSERT INTO `header_ujian` (`id_headersoal`, `nama_ujian`, `tgl_ujian`, `jam_mulai`, `jam_akhir`) VALUES
(1, 'Tes Pengendalian Mutu', '03/16/2018', '22:15', '22:30'),
(2, 'naruto', '03/16/2018', '22:30', '23:00');

-- --------------------------------------------------------

--
-- Table structure for table `j_pesertaujian`
--

CREATE TABLE `j_pesertaujian` (
  `id_jawab` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `id_kontenujian` int(11) NOT NULL,
  `id_headersoal` int(11) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `j_pesertaujian`
--

INSERT INTO `j_pesertaujian` (`id_jawab`, `id_profil`, `id_kontenujian`, `id_headersoal`, `jawaban`) VALUES
(1, 9, 2, 1, 'Gunawan puspo prajoko'),
(2, 9, 3, 1, 'Baik Saja'),
(3, 9, 4, 2, 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `konten_ujian`
--

CREATE TABLE `konten_ujian` (
  `id_kontenujian` int(11) NOT NULL,
  `id_headersoal` int(11) NOT NULL,
  `bab_soal` varchar(25) NOT NULL,
  `soal` text NOT NULL,
  `bobot` int(11) NOT NULL,
  `urut_bab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konten_ujian`
--

INSERT INTO `konten_ujian` (`id_kontenujian`, `id_headersoal`, `bab_soal`, `soal`, `bobot`, `urut_bab`) VALUES
(2, 1, 'Pengetahuan-Dasar', 'Siapakah saya ?', 20, 1),
(3, 1, 'Pengetahuan-Dasar', 'Bagaimana dengan kalian ?', 20, 1),
(4, 2, 'Kukira', 'Master 123', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_bidang`
--

CREATE TABLE `m_bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_bidang`
--

INSERT INTO `m_bidang` (`id_bidang`, `nama_bidang`) VALUES
(1, 'ICT'),
(2, 'C & P'),
(3, 'Personalia'),
(4, 'Design');

-- --------------------------------------------------------

--
-- Table structure for table `m_indikator`
--

CREATE TABLE `m_indikator` (
  `id_indikator` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_indikator` varchar(50) NOT NULL,
  `nama_tim` varchar(50) NOT NULL,
  `jabatan_tim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Manajerial Skill'),
(2, 'Professional Skill'),
(3, 'Personality & Performance');

-- --------------------------------------------------------

--
-- Table structure for table `m_konsentrasi`
--

CREATE TABLE `m_konsentrasi` (
  `id_konsentrasi` int(11) NOT NULL,
  `nama_konsentrasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_konsentrasi`
--

INSERT INTO `m_konsentrasi` (`id_konsentrasi`, `nama_konsentrasi`) VALUES
(1, 'ICT');

-- --------------------------------------------------------

--
-- Table structure for table `partisipasi_ujian`
--

CREATE TABLE `partisipasi_ujian` (
  `id_partisipasi` int(11) NOT NULL,
  `id_headersoal` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partisipasi_ujian`
--

INSERT INTO `partisipasi_ujian` (`id_partisipasi`, `id_headersoal`, `id_profil`) VALUES
(19, 1, 9),
(20, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pkt_akun`
--

CREATE TABLE `pkt_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_pengguna` varchar(25) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pkt_akun`
--

INSERT INTO `pkt_akun` (`id_akun`, `nama_pengguna`, `kata_sandi`, `id_profil`, `status`) VALUES
(1, 'gunawan820', '6797F82F504379E72C59879B12594D39', 9, 1),
(2, 'anug', '6797f82f504379e72c59879b12594d39', 10, 1),
(3, 'testes', '6797f82f504379e72c59879b12594d39', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pkt_nilai`
--

CREATE TABLE `pkt_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pkt_nilai`
--

INSERT INTO `pkt_nilai` (`id_nilai`, `id_indikator`, `id_profil`, `nilai`) VALUES
(1, 60, 9, 80),
(2, 61, 9, 100),
(3, 62, 9, 0),
(4, 63, 9, 0),
(5, 64, 9, 0),
(6, 65, 9, 0),
(7, 66, 9, 0),
(8, 67, 9, 0),
(9, 68, 9, 0),
(10, 69, 9, 0),
(11, 70, 9, 0),
(12, 71, 9, 0),
(13, 72, 9, 0),
(14, 73, 9, 0),
(15, 74, 9, 0),
(16, 75, 9, 0),
(17, 76, 9, 0),
(18, 77, 9, 0),
(19, 78, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pkt_profil`
--

CREATE TABLE `pkt_profil` (
  `id_profil` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nim` varchar(25) DEFAULT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `agama` varchar(4) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `no_wa` varchar(15) DEFAULT NULL,
  `akun_fb` varchar(25) DEFAULT NULL,
  `akun_instagram` varchar(25) DEFAULT NULL,
  `img` varchar(25) DEFAULT NULL,
  `tgl_lahir` varchar(25) NOT NULL,
  `alamat_rumah` text NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `periode_dari` varchar(15) NOT NULL,
  `periode_sampai` varchar(15) NOT NULL,
  `id_konsentrasi` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pkt_profil`
--

INSERT INTO `pkt_profil` (`id_profil`, `nama_lengkap`, `nim`, `jenis_kelamin`, `tempat_lahir`, `agama`, `email`, `no_hp`, `no_wa`, `akun_fb`, `akun_instagram`, `img`, `tgl_lahir`, `alamat_rumah`, `semester`, `tahun_ajaran`, `periode_dari`, `periode_sampai`, `id_konsentrasi`, `id_bidang`) VALUES
(9, 'Gunawan puspo prajoko', '201543501315', 'l', 'DKI Jakarta', 'is', 'gupuspo@gmail.com', '', '', '', '', '1517060593.jpg', '01/01/2018', '', 1, '2017/2018', '01/27/2018', '01/31/2018', 1, 1),
(10, 'Anugrah Prasetyo', '201543501319', 'l', 'DKI Jakarta', 'is', '', '', '', '', '', NULL, '02/22/2018', '', 1, '2017/2018', '02/01/2018', '02/10/2018', 1, 1),
(11, 'Tester', '201543501314', 'l', 'KokO', 'is', '', '', '', '', '', '1519403167.png', '02/22/2018', '', 1, '2017/2018', '02/01/2018', '02/28/2018', 1, 2),
(12, 'Rasengan', '201543501319', 'l', '', 'is', '', '', '', '', '', NULL, '', '', 1, '2017/2018', '03/14/2018', '03/15/2018', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pkt_setting`
--

CREATE TABLE `pkt_setting` (
  `id_set` int(11) NOT NULL,
  `w_rencana` varchar(15) NOT NULL,
  `w_evaluasi` varchar(15) NOT NULL,
  `pesan_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p_waktu`
--

CREATE TABLE `p_waktu` (
  `id_pwaktu` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `jam_buat` varchar(10) NOT NULL,
  `evaluasi_jam` varchar(10) NOT NULL,
  `tanggal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_waktu`
--

INSERT INTO `p_waktu` (`id_pwaktu`, `id_profil`, `jam_buat`, `evaluasi_jam`, `tanggal`) VALUES
(3, 10, '01:35', '02:10', '02/10/2018');

-- --------------------------------------------------------

--
-- Table structure for table `p_waktudasar`
--

CREATE TABLE `p_waktudasar` (
  `id_waktudasar` int(11) NOT NULL,
  `jam_buat` varchar(10) NOT NULL,
  `evaluasi_jam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_waktudasar`
--

INSERT INTO `p_waktudasar` (`id_waktudasar`, `jam_buat`, `evaluasi_jam`) VALUES
(1, '09:00', '17:00');

-- --------------------------------------------------------

--
-- Table structure for table `u_aktifitas`
--

CREATE TABLE `u_aktifitas` (
  `id_aktifitas` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `darijam` varchar(15) NOT NULL,
  `sampaijam` varchar(15) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text,
  `tanggal` varchar(10) NOT NULL,
  `id_profil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `u_aktifitas`
--

INSERT INTO `u_aktifitas` (`id_aktifitas`, `kegiatan`, `darijam`, `sampaijam`, `status`, `keterangan`, `tanggal`, `id_profil`) VALUES
(16, 'Install Firefox', '10:30', '11:30', 1, '', '01/27/2018', 9),
(17, 'Bodo Amat', '11:30', '12:30', 1, '', '01/27/2018', 9),
(19, 'Install Linux', '01:00', '02:00', 1, '', '02/10/2018', 10),
(20, 'Install Rasengan', '02:00', '03:00', 1, '', '02/10/2018', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `header_ujian`
--
ALTER TABLE `header_ujian`
  ADD PRIMARY KEY (`id_headersoal`);

--
-- Indexes for table `j_pesertaujian`
--
ALTER TABLE `j_pesertaujian`
  ADD PRIMARY KEY (`id_jawab`);

--
-- Indexes for table `konten_ujian`
--
ALTER TABLE `konten_ujian`
  ADD PRIMARY KEY (`id_kontenujian`);

--
-- Indexes for table `m_bidang`
--
ALTER TABLE `m_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `m_indikator`
--
ALTER TABLE `m_indikator`
  ADD PRIMARY KEY (`id_indikator`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `m_konsentrasi`
--
ALTER TABLE `m_konsentrasi`
  ADD PRIMARY KEY (`id_konsentrasi`);

--
-- Indexes for table `partisipasi_ujian`
--
ALTER TABLE `partisipasi_ujian`
  ADD PRIMARY KEY (`id_partisipasi`);

--
-- Indexes for table `pkt_akun`
--
ALTER TABLE `pkt_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `pkt_nilai`
--
ALTER TABLE `pkt_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pkt_profil`
--
ALTER TABLE `pkt_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `pkt_setting`
--
ALTER TABLE `pkt_setting`
  ADD PRIMARY KEY (`id_set`);

--
-- Indexes for table `p_waktu`
--
ALTER TABLE `p_waktu`
  ADD PRIMARY KEY (`id_pwaktu`);

--
-- Indexes for table `p_waktudasar`
--
ALTER TABLE `p_waktudasar`
  ADD PRIMARY KEY (`id_waktudasar`);

--
-- Indexes for table `u_aktifitas`
--
ALTER TABLE `u_aktifitas`
  ADD PRIMARY KEY (`id_aktifitas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `header_ujian`
--
ALTER TABLE `header_ujian`
  MODIFY `id_headersoal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `j_pesertaujian`
--
ALTER TABLE `j_pesertaujian`
  MODIFY `id_jawab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konten_ujian`
--
ALTER TABLE `konten_ujian`
  MODIFY `id_kontenujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_bidang`
--
ALTER TABLE `m_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_indikator`
--
ALTER TABLE `m_indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_konsentrasi`
--
ALTER TABLE `m_konsentrasi`
  MODIFY `id_konsentrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partisipasi_ujian`
--
ALTER TABLE `partisipasi_ujian`
  MODIFY `id_partisipasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pkt_akun`
--
ALTER TABLE `pkt_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pkt_nilai`
--
ALTER TABLE `pkt_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pkt_profil`
--
ALTER TABLE `pkt_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pkt_setting`
--
ALTER TABLE `pkt_setting`
  MODIFY `id_set` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_waktu`
--
ALTER TABLE `p_waktu`
  MODIFY `id_pwaktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `p_waktudasar`
--
ALTER TABLE `p_waktudasar`
  MODIFY `id_waktudasar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `u_aktifitas`
--
ALTER TABLE `u_aktifitas`
  MODIFY `id_aktifitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
